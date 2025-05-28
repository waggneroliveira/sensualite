<div class="row">
    <div class="mb-3">
        <label for="title" class="form-label text-dark">Título <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control-input d-block w-100 p-2" id="title{{isset($package->id)?$package->id:''}}" value="{{isset($package)?$package->title:''}}" placeholder="Digite o nome do pacote" required>
    </div>

    <div class="mb-3">
        <label for="package" class="form-label text-dark">Pacote <span class="text-danger">*</span></label>
        <input type="text" name="package" class="form-control-input d-block w-100 p-2" id="package{{isset($package->id)?$package->id:''}}" value="{{isset($package)?$package->package:''}}" placeholder="Digite um texto" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label text-dark">Descrição <span class="text-danger">*</span></label>
        <textarea name="description" id="description" placeholder="Descrição" class="col-12" rows="10">
            {{isset($package)?$package->description:''}}
        </textarea>
    </div>
    <div class="col-lg-12 col-12 d-flex flex-row justify-content-center gap-2 mb-4">
        <div class="col-6">
            <label for="price" class="form-label text-dark">Preço <span class="text-danger">*</span></label>
            <input type="money" name="price" class="d-block w-100 p-2 price" id="price{{isset($package->id)?$package->id:''}}" value="{{isset($package)?$package->price:''}}" placeholder="R$ 0,00" required>
        </div>
        
        <div class="col-6">
            <label for="discount" class="form-label text-dark">Desconto</label>
            <input type="money" name="discount" class="d-block w-100 p-2 price" id="discount{{isset($package->id)?$package->id:''}}" value="{{isset($package)?$package->discount:''}}" placeholder="R$ 0,00">
        </div>
    </div>
</div>


