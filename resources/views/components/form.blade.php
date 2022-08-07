@php
    $routeGroup = 'transfer.'.strtolower($type);
@endphp

<form class="form-horizontal ajax" action="{{ route($routeGroup.'.import') }}" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>{{ $type }}</legend>

        <div class="form-group">
            <label class="col-md-4 control-label">Select File</label>
            <div class="col-md-4">
                <input type="file" name="file" class="input-large">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">And</label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
            </div>
        </div>
    </fieldset>
</form>

<form class="form-horizontal" action="{{ route($routeGroup.'.export') }}" method="get">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label">Or</label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Export</button>
            </div>
        </div>
    </fieldset>
</form>
