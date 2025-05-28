<?php

namespace App\Http\Controllers;

use App\Models\GalleryFile;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class GalleryFileController extends Controller
{
    protected $pathUploadImage = 'admin/uploads/arquivoEnsaio/file';
    protected $pathUploadVideo = 'admin/uploads/arquivoEnsaio/video';
    public function store(Request $request)
    {
        $images = [];
        $videos = [];
    
        try {
            DB::beginTransaction();
            
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $mimeType = $file->getMimeType();
    
                if (str_starts_with($mimeType, 'image/')) {
                    $images[] = ['file' => $file, 'fileName' => $fileName];
                } elseif (str_starts_with($mimeType, 'video/')) {
                    $videos[] = ['file' => $file, 'fileName' => $fileName];
                }
            }
            
            // Caminho da marca d'água
            $watermarkPath = public_path('build/admin/images/marcadagua.webp');

            if (!file_exists($watermarkPath)) {
                throw new \Exception("Marca d'água não encontrada em: $watermarkPath");
            }

            $manager = new ImageManager(new GdDriver());            
            
            foreach ($images as $image) {
                $file = $image['file'];
                $fileName = $image['fileName'];
                
                // Lê imagem e marca d'água
                $img = $manager->read(file_get_contents($file->getRealPath()));
                $watermark = $manager->read(file_get_contents($watermarkPath));

                // Redimensiona a marca d’água proporcional à imagem
                $watermark->resize($img->width(), $img->height());

                // Aplica a marca d’água
                $img->place($watermark, 'center');
            
                // Codifica e salva no Storage
                Storage::put($this->pathUploadImage . '/' . $fileName, (string) $img->encode());

                GalleryFile::create([
                    'gallery_id' => $request->gallery_id,
                    'file' => $this->pathUploadImage . '/' . $fileName,
                    'active' => 0,
                ]);
            }
    
            foreach ($videos as $video) {
                $file = $video['file'];
                $fileName = $video['fileName'];
                $filePath = $file->storeAs($this->pathUploadVideo, $fileName);
    
                GalleryFile::create([
                    'gallery_id' => $request->gallery_id,
                    'file' => $filePath,
                    'active' => 0,
                ]);
            }
    
            DB::commit();
            Session::flash('success', 'Arquivos enviados com sucesso!');
            return redirect()->back();
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao enviar arquivos: ' . $e->getMessage());
        }
    }
    
    public function update(Request $request, GalleryFile $galleryFile){
        $active = $request->active;

        if($active == 'on'){
            $data['active'] = 1;
        }else{
            $data['active'] = 0;
        }
      
        try {
            DB::beginTransaction();
                $galleryFile->fill($data)->save();
            DB::commit();
            Session::flash('success','Arquivo(s) atualizado com sucesso!');
                return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error','Erro ao atualizar arquivo!');
            return redirect()->back();
        }
    }

    public function destroy(GalleryFile $galleryFile)
    {
        Storage::delete(isset($galleryFile->file) ? $galleryFile->file : '');
        $galleryFile->delete();

        Session::flash('success','Arquivo(s) deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if($deleted = GalleryFile::whereIn('id', $request->deleteAll)->delete()){
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
            GalleryFile::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
