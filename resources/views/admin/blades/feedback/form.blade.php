    <div class="mb-3">
        <label for="{{ $textareaId }}" class="form-label text-dark">Responder <span class="text-danger">*</span></label>
        <textarea name="response" id="{{ $textareaId }}" placeholder="Texto" class="col-12" rows="10">
            {{isset($feedback)?$feedback->response:''}}
        </textarea>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input name="active" {{ isset($feedback->active) && $feedback->active == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input" id="invalidCheck{{isset($feedback->id)?$feedback->id:''}}" />
            <label class="form-check-label" for="invalidCheck">{{isset($feedback->active) && $feedback->active == 1?'Desativar comentário?':'Ativar comentário?'}}</label>
            <div class="invalid-feedback">
                You must agree before submitting.
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="d-flex align-items-center gap-2">
            <input name="like" {{ isset($feedback->like) && $feedback->like == 1 ? 'checked' : '' }} type="checkbox" class="form-check-input mt-0" id="invalidCheck-1{{isset($feedback->id)?$feedback->id:''}}" />
            <label class="form-check-label" for="invalidCheck-1">{{isset($feedback->like) && $feedback->like == 1?'Descurtir':'Curtir'}}</label>
        </div>
    </div>