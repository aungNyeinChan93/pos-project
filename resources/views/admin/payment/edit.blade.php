@extends("admin.layouts.master")

@section("content")
    <div class="comtainer-sm">
        <div class="col-8 offset-2">
            <form action="{{ route("payment#update",$payment->id) }}" method="POST">
                @csrf
                @method("put")
                <div class="mb-3">
                    <label for="accName" class="form-label">Account Name</label>
                    <input type="text"
                        class="form-control
                    @error('accName')
                        is-invalid
                    @enderror"
                        id="accName" name="accName"
                        value="{{ old('accName',$payment->account_name) }}">
                    @error('accName')
                        <div class="alert alert-warning mt-2">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="accNumber" class="form-label">Account Number</label>
                    <input type="number"
                        class="form-control
                    @error('accNumber')
                        is-invalid
                    @enderror"
                        id="accNumber" name="accNumber" value="{{ old('accNumber',$payment->account_number) }}">
                    @error('accNumber')
                        <div class="alert alert-warning mt-2">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="accType" class="form-label">Account Type</label>
                    <input type="text"
                        class="form-control
                    @error('accType')
                        is-invalid
                    @enderror"
                        id="accType" name="accType" value="{{ old('accType',$payment->account_type) }}">
                    @error('accType')
                        <div class="alert alert-warning mt-2">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                    @enderror
                </div>

                <input type="submit" value="Update" class="btn btn-sm btn-info my-2">
                <a href="{{ route("payment#list") }}" class="btn btn-sm btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection
