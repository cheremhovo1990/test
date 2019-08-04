@extends('layouts.app')

@section('content')
    <form method="POST" action="?">
        @csrf
        <div class="form-group">
            <label for="reason" class="col-form-label">Reason</label>
            <textarea name="reason" id="reason" class="form-control{{$errors->has('reason') ? ' is-invalid' : ''}}"
                      cols="30" rows="10" required>{{old('reason', $advert->reject_reason)}}</textarea>
            @if($errors->has('reason'))
                <span class="invalid-feedback">{{$errors->first('reason')}}</span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Reject</button>
        </div>
    </form>
@endsection
