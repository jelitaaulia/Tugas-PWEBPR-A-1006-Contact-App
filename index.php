<?php
include 'database.php';

// Inisialisasi koneksi ke database
$db = new Database();
$conn = $db->getConnection();

// Query untuk mengambil data kontak
$sql = "SELECT * FROM contact_info";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap'); *{font-family: 'Poppins', sans-serif};</style>
</head>
<body class=" h-screen bg-slate-200 flex flex-row">
  <aside class="shadow-lg w-44 bg-white h-screen flex flex-col items-center">
    <p class="font-bold text-center my-10 text-white p-8 -mt-1 bg-blue-600">Contact Management</p>
    <img class="h-14 w-14 rounded-full border-blue-600 border" src="https://images.unsplash.com/photo-1502323777036-f29e3972d82f?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
    <div class="fitur1 flex flex-col my-10 text-blue-600 font-semibold">
      <a href="" class="hover:text-blue-800 w-44 p-3 text-center hover:bg-slate-200">Home</a>
      <a href="" class="hover:text-blue-800 border-y w-44 p-3 text-center hover:bg-slate-200">Contact</a>
      <a href="" class="hover:text-blue-800 border-b w-44 p-3 text-center hover:bg-slate-200">FAQ</a>
      <a href="" class="hover:text-blue-800 w-44 p-3 text-center hover:bg-slate-200">About</a>
    </div>
    <div class="fitur2  flex flex-col mt-14 text-blue-600 font-semibold">
      <a href="" class="hover:text-blue-800 border-b w-44 p-3 text-center hover:bg-slate-200">Profile</a>
      <a href="" class="hover:text-red-800 text-red-600 w-44 p-3 text-center hover:bg-slate-200">Logout</a>
    </div>
  </aside>
  <main class="flex flex-col w-full">
    <p class="text-3xl font-bold text-blue-600 p-4 my-6 mx-10">DASHBOARD CONTACT</p>
    <button class="w-40 p-2 bg-blue-600 text-sm font-semibold text-white rounded-full ml-14 hover:bg-blue-800">+ Add Contact</button>
    <table class="w-[1050px] text-sm text-center ml-16 my-10">
      <thead id="col" class="text-sm bg-blue-600 text-white">                 
          <tr>
              <th scope="col" class="px-16 py-3">ID</th>
              <th scope="col" class="px-16 py-3">Phone Number</th>
              <th scope="col" class="px-16 py-3">Owner</th>
              <th scope="col" class="px-16 py-3">Action</th>
          </tr>
      </thead>
      <tbody>
      <?php
      if ($result->num_rows > 0) {
          // Loop untuk menampilkan setiap baris data
          $index = 0;
          while ($row = $result->fetch_assoc()) {
              $row_class = $index % 2 == 0 ? 'bg-transparent' : 'bg-slate-300'; // Atur kelas warna latar belakang untuk baris ganjil dan genap
              echo "<tr class='$row_class'>";
              echo "<td scope='row' class='px-6 py-4 font-medium text-gray-700'>" . $row["id"] . "</td>";
              echo "<td class='px-6 py-4'>" . $row["phone_number"] . "</td>";
              echo "<td class='px-6 py-4'>" . $row["owner"] . "</td>";
              echo "<td class='px-6 py-4'>
                      <div class='flex justify-center space-x-4'>
                          <form action='view.php' method='post'>
                              <input type='hidden' name='id' value='" . $row["id"] . "'>
                              <button class='p-1.5 w-20 bg-green-600 text-white border rounded-full hover:bg-green-800'>View</button>
                          </form>
                          <form action='edit.php' method='post'>
                              <input type='hidden' name='id' value='" . $row["id"] . "'>
                              <button class='p-1.5 w-20 bg-yellow-600 text-white border rounded-full hover:bg-yellow-800'>Edit</button>
                          </form>
                          <form action='delete.php' method='post'>
                              <input type='hidden' name='id' value='" . $row["id"] . "'>
                              <button type='submit' class='p-1.5 w-20 bg-red-600 text-white border rounded-full hover:bg-red-800' onclick='return confirm(\"Apakah Anda yakin ingin menghapus kontak ini?\")'>Delete</button>
                          </form>
                      </div>
                  </td>";
              echo "</tr>";
              $index++;
          }
      } else {
          echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
      }
      ?>
      </tbody>
    </table>
  </main>
</body>
</html>
