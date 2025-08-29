<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Locations</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Locations
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <button wire:click='addLocation()' type="button" class="btn btn-info">Add location</button>
            </div>
        </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">


        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($locations as $location)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $location->name }}</td>
                            <td>{{ $location->address }}</td>
                            <td>{{ $location->phone }}</td>
                            <td><button wire:click='deleteLocation({{ $location->id }})' type="button"
                                    class="btn btn-dark">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center text-danger">
                            <td colspan="6">Don't have data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Delete --}}
    <div wire:ignore.self class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <form wire:submit='deleteConfirm()' class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Delete Location
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Location name: <span class="text-danger">{{ $nameLocationDelete }}</span></label>
                        <input class="form-control" wire:model='nameLocation' type="text" placeholder="name">
                        @error('nameLocation')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="location-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <form wire:submit='createLocation()' class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Add location
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" placeholder="Johnny Brown" wire:model='name'
                            autocomplete="false">

                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input class="form-control" type="text" placeholder="..." autofocus wire:model='address'>

                        @error('address')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" type="text" placeholder="..." wire:model='phone'>

                        @error('phone')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Script --}}
<script>
    window.addEventListener('showLocationModal', function() {
        $('#location-modal').modal('show');
    });

    window.addEventListener('hideLocationModal', function() {
        $('#location-modal').modal('hide');
    });

    window.addEventListener('showDeleteModal', function() {
        $('#delete-modal').modal('show');
    });

    window.addEventListener('hideDeleteModal', function() {
        $('#delete-modal').modal('hide');
    });
</script>
