<?php
//Nadhira Adhya 21552011373
// Kelas Book 
class Book {
    // Properti statis
    private static $totalBooks = 0;
    protected $title;
    protected $author;
    protected $year;
    protected $isBorrowed;

    // Daftar semua buku yang telah dibuat
    private static $bookList = [];

    // Constructor (Konstruktor)
    public function __construct($title, $author, $year) {
        // Inisialisasi properti
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->isBorrowed = false;
        self::$totalBooks++;
        self::$bookList[] = $this; // Menambahkan buku ke dalam daftar buku
    }

    // Getter untuk mengakses properti statis
    public static function getTotalBooks() {
        return self::$totalBooks;
    }

    // Getter untuk menampilkan informasi buku
    public function getInfo() {
        return "Judul: {$this->title},
        Penulis: {$this->author}, 
        Tahun Terbit: {$this->year}, 
        Status: " . ($this->isBorrowed ? "Dipinjam" : "Tersedia");
    }

    // Method untuk meminjam buku
    public function borrowBook() {
        if (!$this->isBorrowed) {
            $this->isBorrowed = true;
            return true;
        }
        return false;
    }

    // Method untuk mengembalikan buku
    public function returnBook() {
        if ($this->isBorrowed) {
            $this->isBorrowed = false;
            return true;
        }
        return false;
    }

    // Getter untuk properti isBorrowed
    public function getIsBorrowed() {
        return $this->isBorrowed;
    }

    // Method untuk menambahkan buku baru
    public static function addNewBook($title, $author, $year) {
        new Book($title, $author, $year);
    }

    // Getter untuk daftar semua buku
    public static function getBookList() {
        return self::$bookList;
    }
}

// Kelas EBook (turunan dari Book)
class EBook extends Book {
    // Properti tambahan untuk EBook
    private $format;

    // Constructor khusus untuk EBook
    public function __construct($title, $author, $year, $format) {
        // Memanggil constructor dari kelas induk (Book)
        parent::__construct($title, $author, $year);
        // Inisialisasi properti tambahan
        $this->format = $format;
    }

    // Override method getInfo untuk menampilkan informasi tambahan tentang EBook
    public function getInfo() {
        // Memanggil method getInfo dari kelas induk (Book) dan menambahkan informasi format
        return parent::getInfo() . ", Format: {$this->format}";
    }
}

// Membuat beberapa instance buku
$book1 = new Book("Dilan 1990", "Pidi Baiq", 2014);
echo "\n";
$book2 = new Book("Laut Bercerita", "Leila Salikha Chudori", 2017);
echo "\n";
$ebook1 = new EBook("Mariposa", "Luluk HF.", 2018, "PDF");

// Menambahkan buku baru
Book::addNewBook("The Catcher in the Rye", "J.D. Salinger", 1951);

// Cetak informasi buku, status meminjam, dan status pengembalian buku
echo "Informasi Buku:\n";
foreach (Book::getBookList() as $book) {
    echo $book->getInfo() . "\n";
}

// Meminjam buku
$book1->borrowBook();
echo "Status Pinjam Buku 1: " . ($book1->getIsBorrowed() ? "Dipinjam" : "Tersedia") . "\n";

// Mengembalikan buku
$book1->returnBook();
echo "Status Pinjam Buku 1 Setelah Pengembalian: " . ($book1->getIsBorrowed() ? "Dipinjam" : "Tersedia") . "\n";
?>
