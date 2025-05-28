<div class="row">
    <div class="mb-3">
        <label for="name" class="form-label text-dark">Nome <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control-input d-block w-100 p-2" id="name{{isset($plan->id)?$plan->id:''}}" value="{{isset($plan)?$plan->name:''}}" placeholder="Digite o nome do plano" required>
    </div>

    <div class="mb-3">
        <label for="duration" class="form-label text-dark">Duração do plano <span class="text-danger">*</span></label>
        <input type="text" name="duration" class="form-control-input d-block w-100 p-2" id="duration{{isset($plan->id)?$plan->id:''}}" value="{{isset($plan)?$plan->duration:''}}" placeholder="Digite a duração do plano" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label text-dark">Descrição <span class="text-danger">*</span></label>
        <input type="text" name="description" class="form-control-input d-block w-100 p-2" id="description{{isset($plan->id)?$plan->id:''}}" value="{{isset($plan)?$plan->description:''}}" placeholder="Digite um texto" required>
    </div>

    <div class="mb-3">
        <label for="{{ $textareaId }}" class="form-label text-dark">Features <span class="text-danger">*</span></label>
        <textarea name="features" id="{{ $textareaId }}" placeholder="Texto" class="col-12" rows="10">
            {{isset($plan)?$plan->features:''}}
        </textarea>
    </div>
    <div class="col-lg-12 col-12 d-flex flex-row justify-content-center gap-2 mb-4">
        <div class="col-6">
            <label for="price" class="form-label text-dark">Preço <span class="text-danger">*</span></label>
            <input type="money" name="price" class="d-block w-100 p-2 price" id="price{{isset($plan->id)?$plan->id:''}}" value="{{isset($plan)?$plan->price:''}}" placeholder="R$ 0,00" required>
        </div>
        
        <div class="col-6">
            <label for="discount" class="form-label text-dark">Desconto</label>
            <input type="money" name="discount" class="d-block w-100 p-2 price" id="discount{{isset($plan->id)?$plan->id:''}}" value="{{isset($plan)?$plan->discount:''}}" placeholder="R$ 0,00">
        </div>
    </div>
    <div class="mb-3">
        <label for="{{ $textareaId }}" class="form-label text-dark">Texto <span class="text-danger">*</span></label>
        <textarea name="cancellation_policy" id="{{ $textareaId }}" placeholder="Política de cancelamento" class="col-12" rows="10">
            {{isset($plan)?$plan->description:''}}
        </textarea>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input name="status" {{ isset($plan->status) && $plan->status == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input" id="invalidCheck{{isset($plan->id)?$plan->id:''}}" />
            <label class="form-check-label text-dark" for="invalidCheck">Ativo?</label>
            <div class="invalid-feedback">
                You must agree before submitting.
            </div>
        </div>
    </div>
    
</div>


