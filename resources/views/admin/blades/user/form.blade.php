<div class="mb-3">
    <label for="name" class="form-label">Usuários <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control-input d-block w-100 p-2" id="name{{isset($user->id)?$user->id:''}}" value="{{isset($user)?$user->name:''}}" placeholder="Digite seu nome" required>
</div>
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email <span class="text-danger">*</span></label>
    <input type="email" name="email" value="{{isset($user)?$user->email:''}}" class="form-control-input d-block w-100 p-2" id="exampleInputEmail1{{isset($user->id)?$user->id:''}}" placeholder="Digite seu email" required>
</div>

<div class="mb-3">
    <label for="password" class="form-label">Senha <span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">
        <input type="password" name="password" id="password-{{ isset($user->id) ? $user->id : '' }}" class="form-control-input d-block w-100 p-2" placeholder="Digite sua senha" {{ !isset($user) ? 'required' : '' }}>
    </div>
</div>

<div class="col-lg-12">
    <div class="mt-3">
        <input type="file" name="path_image" data-plugins="dropify" data-default-file="{{isset($user)?$user->path_image<>''?url('storage/'.$user->path_image):'':''}}"  />
        <p class="text-muted text-center mt-2 mb-0">Adicione uma imagem com tamanho máximo de <b class="text-danger">2 MB</b>.</p>
    </div>
</div>
<div class="mb-3">
    <div class="form-check">
        <input name="active" {{ isset($user->active) && $user->active == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input" id="invalidCheck{{isset($user->id)?$user->id:''}}" />
        <label class="form-check-label" for="invalidCheck">Ativo?</label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
</div>

@if ($currentRoles->isNotEmpty())
    @foreach($currentRoles as $role)  
        <input type="hidden" name="roles[]" value="{{ $role->name }}">                    
    @endforeach        
@endif
