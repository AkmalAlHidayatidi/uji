<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRUD Sederhana</title>
    <link rel="stylesheet" href="styles.css" />
    <script>
      let users = [];

      async function loadUsers() {
        try {
          const response = await fetch("users.json");
          users = await response.json();
        } catch (error) {
          users = [];
        }
        displayUsers();
      }

      async function saveUsers() {
        await fetch("save.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(users),
        });
        await loadUsers(); // Reload data from JSON after saving
      }

      function addUser(event) {
        event.preventDefault();
        const name = document.getElementById("name").value;
        if (name) {
          users.push({
            id: users.length > 0 ? users[users.length - 1].id + 1 : 1,
            name,
          });
          saveUsers();
          document.getElementById("name").value = "";
        }
      }

      function deleteUser(id) {
        users = users.filter((user) => user.id !== id);
        saveUsers();
      }

      function displayUsers() {
        const tableBody = document.getElementById("userTable");
        tableBody.innerHTML = "";
        users.forEach((user) => {
          const row = `<tr>
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>
                        <button onclick="deleteUser(${user.id})">Hapus</button>
                    </td>
                </tr>`;
          tableBody.innerHTML += row;
        });
      }

      document.addEventListener("DOMContentLoaded", loadUsers);
    </script>
  </head>
  <body>
    <h2>CRUD Sederhana</h2>

    <form onsubmit="addUser(event)">
      <input type="text" id="name" placeholder="Masukkan Nama" required />
      <button type="submit">Tambah</button>
    </form>

    <table border="1">
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Aksi</th>
      </tr>
      <tbody id="userTable"></tbody>
    </table>
  </body>
</html>
