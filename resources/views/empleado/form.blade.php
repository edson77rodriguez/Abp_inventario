<div class="row padding-1 p-1">
    <div class="col-md-12">
        
    <div class="form-group mb-2 mb20">
        <label for="person_id" class="form-label">{{ __('Persona') }}</label>
        <select name="person_id" class="form-control @error('person_id') is-invalid @enderror" id="person_id">
            @foreach ($personas as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
            @endforeach
        </select>

        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>