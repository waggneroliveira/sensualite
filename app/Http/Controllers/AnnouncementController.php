<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Companion;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\CompanionCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class AnnouncementController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/anuncio/';
    public function index()
    {   
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('anuncio.visualizar')){
            return abort(403, 'Acesso não autorizado.');
        }
        $companions = Companion::active()->sorting()->get();
        $announcements = Announcement::sorting()->get();
        $categories =  CompanionCategory::active()->get();

        return view('admin.blades.announcetement.index', compact('categories', 'announcements', 'companions'));
    }

    public function store(Request $request)
    {
        $data = $request->except('path_image');
        $helper = new HelperArchive();
        
        $request->validate([
            'path_image' => 'sometimes', 'nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif',
        ]);
        $path_image = $request->hasFile('path_image') 
        ? $helper->renameArchiveUpload($request, 'path_image') 
        : null;
        try {
            DB::beginTransaction();
                if ($path_image) {
                    $data['path_image'] = $this->pathUpload . $path_image;
                    $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                }
                $data['start_date'] = Carbon::parse($data['start_date'])->setTimeFromTimeString(now()->toTimeString())->format('Y-m-d H:i:s');
                $data['end_date'] = Carbon::parse($data['end_date'])->setTimeFromTimeString(now()->toTimeString())->format('Y-m-d H:i:s');

                $announcement = Announcement::create($data);
            DB::commit();
            Session::flash('success', 'Item cadastrado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('error', 'Erro ao cadastrar item!');
            return redirect()->back();
        }
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->except('path_image');
        $helper = new HelperArchive();
        
        $request->validate([
            'path_image' => 'sometimes', 'nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif',
        ]);
        $path_image = $request->hasFile('path_image') 
        ? $helper->renameArchiveUpload($request, 'path_image') 
        : null;

        try {
            DB::beginTransaction();
                if ($path_image) {
                    $data['path_image'] = $this->pathUpload . $path_image;
                    $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                }

                $data['start_date'] = $request->start_date 
                ? \Carbon\Carbon::parse($request->start_date)->setTime(now()->hour, now()->minute, now()->second)->format('Y-m-d H:i:s') 
                : null;
        
                $data['end_date'] = $request->end_date 
                ? \Carbon\Carbon::parse($request->end_date)->setTime(23, 59, 59)->format('Y-m-d H:i:s') 
                : null;
                
                $announcement->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Item atualizado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('error', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }


    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        Session::flash('error', 'Erro ao atualizar item!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        foreach ($request->deleteAll as $announcementId) {
            $announcement = Announcement::find($announcementId);
    
            if ($announcement) {

                activity()
                    ->causedBy(Auth::guard('acompanhante')->user())
                    ->performedOn($announcement)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $announcementId,
                            'companion_id' => $announcement->companion_id,
                            'title' => $announcement->title,
                            'description' => $announcement->description,
                            'start_date' => $announcement->start_date,
                            'end_date' => $announcement->end_date,
                            'status' => $announcement->status,
                            'notes' => $announcement->notes,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                \Log::warning("Item com ID $announcementId não encontrado.");
            }
        }

        $deleted = Announcement::whereIn('id', $request->deleteAll)->delete();
    
        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '. 'Itens deletados com sucesso!']);
        }
    
        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }
    
    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id) {
            $announcement = Announcement::find($id);

            if($announcement) {
                
                $announcement->sorting = $sorting;
                $announcement->save();

                activity()
                    ->causedBy(Auth::guard('acompanhante')->user())
                    ->performedOn($announcement)
                    ->event('order_updated')
                    ->withProperties([
                        'attributes' => [
                            'id' => $id,
                            'title' => $announcement->title,
                            'sorting' => $sorting,
                            'event' => 'order_updated',
                        ]
                    ])
                    ->log('order_updated');
            } else {
                \Log::warning("Item com ID $id não encontrado.");
            }
        }
    
        return Response::json(['status' => 'success']);
    }
}
