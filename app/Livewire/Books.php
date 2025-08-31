<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;

class Books extends Component
{
    public $name, $content, $author, $id;

    public $bookId;

    public $deleteName;

    public $nameBook;

    public $isUpdateMode = false;

    public function render()
    {
        $books = Book::all();
        return view('livewire.books', [
            'books' => $books
        ]);
    }

    protected function resetData()
    {
        $this->resetErrorBag();
        $this->name = $this->content = $this->author = $this->bookId = $this->nameBook = $this->deleteName = '';
        $this->isUpdateMode = false;
    }

    protected function rules()
    {
        return [
            "name" => 'required|unique:books,name,' . ($this->bookId ? $this->bookId : '') ,
            "content" => 'required',
            "author" => 'required',
        ];
    }

    protected function messages() {
        return [
            'name.required' => 'Tên sách là bắt buộc',
            'name.unique' => 'Tên sách đã tồn tại',
            'content.required' => 'Nội dung là bắt buộc',
            'author.required' => 'Tác giả là bắt buộc',
        ];
    }

    public function addBook()
    {
        $this->resetData();
        $this->dispatch('showBookModal');
    }

    public function createBook()
    {
        //dd($this->all());

        $this->validate();

        Book::create([
            "name" => $this->name,
            "content" => $this->content,
            "author" => $this->author,
        ]);
        $this->resetData();
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
        $deleteName = $this->deleteName;

        if ($oldName === $deleteName) {
            $book->delete();
            $this->resetData();
            $this->dispatch('hideDeleteModal');
        } else {
            $this->addError('deleteName', 'do not match');
        }
    }

    public function editBook($id)
    {
        $this->resetErrorBag();
        $book = Book::find($id);
        $this->bookId = $book->id;
        $this->name = $book->name;
        $this->author = $book->author;
        $this->content = $book->content;
        $this->isUpdateMode = true;
        $this->dispatch('showBookModal');
    }

    public function updateBook()
    {
        $this->validate();
        $book = Book::find($this->bookId);
        $book->update([
            'name' => $this->name,
            'author' => $this->author,
            'content' => $this->content,
        ]);

        $this->resetData();
        $this->dispatch('hideBookModal');
    }
}
