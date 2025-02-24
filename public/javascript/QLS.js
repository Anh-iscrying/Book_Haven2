function deleteBook(bookId) {
  if (confirm("Bạn có chắc chắn muốn xóa sách này không?")) {
      fetch(`api_qls.php?id=${bookId}`, {
          method: 'DELETE',
      })
      .then(response => response.json())
      .then(data => {
          alert(data.message);
          location.reload(); // Refresh lại trang
      })
      .catch(error => console.error("Error:", error));
  }
}

function editBook(bookId, bookTitle) {
  document.getElementById("edit-form").style.display = "block";
  document.getElementById("edit-book-id").value = bookId;
  document.getElementById("edit-title").value = bookTitle;
}

document.getElementById("edit-form").addEventListener("submit", function (e) {
  e.preventDefault();
  const bookId = document.getElementById("edit-book-id").value;
  const bookTitle = document.getElementById("edit-title").value;

  fetch("api_qls.php", {
      method: 'PUT',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({
          book_id: bookId,
          book_title: bookTitle,
          book_image: "default_image.jpg" // Cập nhật thêm nếu có
      })
  })
  .then(response => response.json())
  .then(data => {
      alert(data.message);
      location.reload(); // Refresh lại trang
  })
  .catch(error => console.error("Error:", error));
});

// Hàm hiển thị form sửa
function editBook(bookId, bookTitle) {
  document.getElementById("edit-form").style.display = "block";
  document.getElementById("edit-book-id").value = bookId;
  document.getElementById("edit-title").value = bookTitle;
}

// Hàm hủy sửa
function cancelEdit() {
  document.getElementById("edit-form").style.display = "none";
}

// Sự kiện submit form sửa
document.getElementById("edit-book-form").addEventListener("submit", function (e) {
  e.preventDefault();

  const bookId = document.getElementById("edit-book-id").value;
  const bookTitle = document.getElementById("edit-title").value;

  fetch("api_qls.php", {
      method: 'PUT',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({
          book_id: bookId,
          book_title: bookTitle,
          book_image: "default_image.jpg" // Cập nhật thêm nếu cần
      })
  })
  .then(response => response.json())
  .then(data => {
      alert(data.message);
      location.reload(); // Refresh lại trang sau khi sửa
  })
  .catch(error => console.error("Error:", error));
});

