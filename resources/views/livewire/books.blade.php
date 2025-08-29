<div>
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Books</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Books
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <button wire:click='addBook()' type="button" class="btn btn-info">Add book</button>
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
                            <th scope="col">Author</th>
                            <th scope="col">Content</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->name }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->content }}</td>
                                <td>
                                    <button wire:click='editBook({{ $book->id }})' type="button"
                                        class="btn btn-dark">Edit</button>
                                    <button wire:click='deleteBook({{ $book->id }})' type="button"
                                        class="btn btn-danger">Delete</button>

                                </td>
                            </tr>
                        @empty
                            <tr class="text-center text-danger">
                                <td colspan="5">Don't have data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Delete Book --}}
        <div wire:ignore.self class="modal fade" id="delete-modal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Delete book
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name book</label>
                            <input wire:model='deleteName' class="form-control" type="text"
                                placeholder="{{ $nameBook }}">

                            @error('deleteName')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button wire:click='deleteConfirm()' type="submit" class="btn btn-primary">
                            Delete
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="Book-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <form wire:submit='{{ $isUpdateMode ? 'updateBook()' : 'createBook()' }}' class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ $isUpdateMode ? 'Edit book' : 'Add book' }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Name book</label>
                        <input class="form-control" type="text" wire:model='name'>

                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Author</label>
                        <input class="form-control" type="text" placeholder="Johnny Brown" wire:model='author'>

                        @error('author')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <input class="form-control" type="text" placeholder="..." wire:model='content'>

                        @error('content')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ $isUpdateMode ? 'Edit book' : 'Add book' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




{{-- Script --}}
<script>
    window.addEventListener('showBookModal', function() {
        $('#Book-modal').modal('show');
    });

    window.addEventListener('hideBookModal', function() {
        $('#Book-modal').modal('hide');
    });

    window.addEventListener('showDeleteModal', function() {
        $('#delete-modal').modal('show');
    });

    window.addEventListener('hideDeleteModal', function() {
        $('#delete-modal').modal('hide');
    });
</script>
