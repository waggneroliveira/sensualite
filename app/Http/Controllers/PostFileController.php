<?php

namespace App\Http\Controllers;

use App\Models\PostFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PostFileController extends Controller
{
    protected $pathUploadImage = 'admin/uploads/file/arquivoPost';
    protected $pathUploadVideo = 'admin/uploads/video/arquivoPost';

    public function store(Request $request)
    {
        $images = [];
        $videos = [];

        try {
            DB::beginTransaction();

            // Itera sobre cada arquivo
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName(); // Renomear o arquivo, se necessário
                $mimeType = $file->getMimeType(); // Obtém o tipo MIME do arquivo

                // Verifica se é uma imagem
                if (str_starts_with($mimeType, 'image/')) {
                    $images[] = ['file' => $file, 'fileName' => $fileName];
                }
                // Verifica se é um vídeo
                elseif (str_starts_with($mimeType, 'video/')) {
                    $videos[] = ['file' => $file, 'fileName' => $fileName];
                }
            }

            foreach ($images as $image) {
                $file = $image['file'];
                $fileName = $image['fileName'];
                $filePath = $file->storeAs($this->pathUploadImage, $fileName);
                // Salva o caminho no banco de dados
                PostFile::create([
                    'post_id' => $request->post_id,
                    'file' => $filePath,
                ]);
            }

            foreach ($videos as $video) {
                $file = $video['file'];
                $fileName = $video['fileName'];
                $filePath = $file->storeAs($this->pathUploadVideo, $fileName);
                // Salva o caminho no banco de dados
                PostFile::create([
                    'post_id' => $request->post_id,
                    'file' => $filePath,
                ]);
            }

            DB::commit();
            Session::flash('success', 'Arquivos enviados com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Selecione uma galeria para cadastrar os arquivos.');
        }
    }

    public function update(Request $request, PostFile $postFile){
        $active = $request->active;

        if($active == 'on'){
            $data['active'] = 1;
        }else{
            $data['active'] = 0;
        }

        try {
            DB::beginTransaction();
                $postFile->fill($data)->save();
            DB::commit();
            Session::flash('success','Arquivo(s) atualizado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error','Erro ao atualizar arquivo!');
            return redirect()->back();
        }
    }

    public function destroy(PostFile $postFile)
    {
        Storage::delete(isset($postFile->file) ? $postFile->file : '');
        $postFile->delete();

        Session::flash('success','Arquivo(s) deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if($deleted = PostFile::whereIn('id', $request->deleteAll)->delete()){
            return Response::json
            (
                [
                    'status' => 'success',
                    'message' => $deleted.' itens deletados com sucessso!'
                ]
            );
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            PostFile::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
