<div class="row">
    <div class="mb-3 col-12 d-flex align-items-start flex-column">
        <label for="title" class="form-label text-dark">Categoria</label>
        <input type="text" name="title" class="form-control-input d-block w-100 p-2" id="title{{isset($category->id)?$category->id:''}}" value="{{isset($category)?$category->title:''}}" placeholder="Digite o título" required>
    </div>
</div>
<div class="col-lg-4">     
    <label class="mb-3">Imagem</label>   
    <input type="file" name="path_image" class="small" data-plugins="dropify" data-default-file="{{isset($category)?$category->path_image<>''?url('storage/'.$category->path_image):'':''}}"  />
    <p class="text-muted small text-left mt-2 mb-0">Tamanho máximo de <b class="text-danger">2 MB</b>.</p>     
</div>
<div class="mb-3">
    <div class="form-check d-flex align-items-start gap-1">
        <input name="active" {{ isset($category->active) && $category->active == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input" id="invalidCheck{{isset($category->id)?$category->id:''}}" />
        <label class="form-check-label text-dark" for="invalidCheck">Ativo?</label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
</div>