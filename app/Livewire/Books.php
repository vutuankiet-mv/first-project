<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;

class Books extends Component
{
    public $name, $content, $author, $id;

    public $bookId;

    public $oldName;

    public $deleteName;

    public $nameBook;

    public function render()
    {
        $books = Book::all();
        return view('livewire.books', [
            'books' => $books
        ]);
    }

    public function addBook()
    {
        $this->name = $this->content = $this->author = '';
        $this->resetErrorBag();
        $this->dispatch('showBookModal');
    }

    public function createBook()
    {
        //dd($this->all());

        $this->validate([
            "name" => 'required|unique:books,name',
            "content" => 'required',
            "author" => 'required',
        ], [
            'name.required' => 'Tên sách là bắt buộc'
        ]);

        Book::create([
            "name" => $this->name,
            "content" => $this->content,
            "author" => $this->author,
        ]);

        $this->dispatch('hideBookModal');
    }

    public function deleteBook($id)
    {
        $this->resetErrorBag();
        $this->name = $this->content = $this->author = '';
        $book = Book::find($id);
        $this->bookId = $book->id;
        $this->nameBook = $book->name;
        $this->dispatch('showDeleteModal');
    }

    public function deleteConfirm()
    {
        $this->validate([
            'deleteName' => 'required',
        ]);
        $book = Book::find($this->bookId);
        $oldName = $book->name;
        $deleteName = $this->name;

        if ($oldName === $deleteName) {
            $book->delete();
            $this->dispatch('hideDeleteModal');
        } else {
            $this->addError('deleteName','do not match');
        }
    }
}
