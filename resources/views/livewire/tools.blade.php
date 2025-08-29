 <div class="min-height-200px">
     <div class="page-header">
         <div class="row">
             <div class="col-md-6 col-sm-12">
                 <div class="title">
                     <h4>Tools</h4>
                 </div>
                 <nav aria-label="breadcrumb" role="navigation">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item">
                             <a href="index.html">Home</a>
                         </li>
                         <li class="breadcrumb-item active" aria-current="page">
                             Tools
                         </li>
                     </ol>
                 </nav>
             </div>
             <div class="col-md-6 col-sm-12 text-right">
                 <button wire:click='addTool()' type="button" class="btn btn-info">Add tool</button>
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
                         <th scope="col">Description</th>
                         <th scope="col">Actions</th>

                     </tr>
                 </thead>
                 <tbody>
                     @forelse ($tools as $tool)
                         <tr>
                             <td scope="col">{{ $loop->iteration }}</td>
                             <td scope="col">{{ $tool->name }}</td>
                             <td scope="col">{{ $tool->description }}</td>
                             <td><button wire:click='deleteTool({{ $tool->id }})' type="button"
                                     class="btn btn-dark">Delete</button></td>
                         </tr>
                     @empty
                         <tr>
                             <td class="text-center text-danger" colspan="4">Don't have data</td>
                         </tr>
                     @endforelse
                 </tbody>
             </table>
         </div>

         {{-- Delete --}}
         <div wire:ignore.self class="modal fade" id="delete-modal" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog modal-sm modal-dialog-centered">
                 <form wire:submit='deleteConfirm()' class="modal-content">
                     <div class="modal-header">
                         <h4 class="modal-title" id="myLargeModalLabel">
                             Delete tool
                         </h4>
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                             ×
                         </button>
                     </div>
                     <div class="modal-body">
                         <div class="form-group row">
                             <label class="col-sm-12 col-md-2 col-form-label">Name</label>



                             <div class="col-sm-12 col-md-10">
                                 <input wire:model='nameTool' class="form-control" type="text"
                                     placeholder="{{ $nameToolDelete }}">
                                 @error('nameTool')
                                     <small class="form-text text-danger">{{ $message }}</small>
                                 @enderror
                             </div>
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

     </div>

     {{-- Modal --}}
     <div wire:ignore.self class="modal fade" id="tool-modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
         <div class="modal-dialog modal-dialog-centered">
             <form wire:submit='createTool()' class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title" id="myLargeModalLabel">
                         Add tool
                     </h4>
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                         ×
                     </button>
                 </div>
                 <div class="modal-body">

                     <div class="form-group">
                         <label>Name tool</label>
                         <input class="form-control" type="text" wire:model='name'>

                         @error('name')
                             <small class="form-text text-danger">{{ $message }}</small>
                         @enderror
                     </div>

                     <div class="form-group">
                         <label>Description</label>
                         <input class="form-control" type="text" placeholder="Johnny Brown" wire:model='description'>

                         @error('description')
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
     window.addEventListener('showToolModal', function() {
         $('#tool-modal').modal('show');
     });

     window.addEventListener('hideToolModal', function() {
         $('#tool-modal').modal('hide');
     });

     window.addEventListener('showDeleteModal', function() {
         $('#delete-modal').modal('show');
     });

      window.addEventListener('hideDeleteModal', function() {
         $('#delete-modal').modal('hide');
     });
 </script>
