<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Management System</title>
    <style>
        /* Basic styling for demo purposes */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Cat Management System</h1>

    <h2>Add a New Cat</h2>
    <form id="addCatForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br><br>
        
        <label for="ownerName">Owner's Name:</label>
        <input type="text" id="ownerName" name="ownerName" required><br><br>
        
        <button type="submit">Add Cat</button>
    </form>

    <h2>Search Cats by Owner Name</h2>
    <form id="searchForm">
        <label for="searchOwnerName">Owner's Name:</label>
        <input type="text" id="searchOwnerName" name="searchOwnerName">
        <button type="submit">Search</button>
    </form>

    <h2>List of Cats</h2>
    <table id="catsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Owner's Name</th>
            </tr>
        </thead>
        <tbody id="catsTableBody">
            <!-- Cats will be dynamically inserted here -->
        </tbody>
    </table>

    <script>
        // Fetch cats from backend when page loads
        document.addEventListener('DOMContentLoaded', function() {
            fetchCats();
        });

        // Function to fetch cats from backend
        function fetchCats(ownerName = '') {
            let url = '/api/cats';
            if (ownerName) {
                url += `?owner_name=${encodeURIComponent(ownerName)}`;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const catsTableBody = document.getElementById('catsTableBody');
                    catsTableBody.innerHTML = ''; // Clear existing table rows

                    data.forEach(cat => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${cat.id}</td>
                            <td>${cat.name}</td>
                            <td>${cat.dob}</td>
                            <td>${cat.owner_name}</td>
                        `;
                        catsTableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching cats:', error);
                    alert('Failed to fetch cats. Please check console for details.');
                });
        }

        // Add event listener to form for adding new cat
        document.getElementById('addCatForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const catData = {
                name: formData.get('name'),
                dob: formData.get('dob'),
                owner_name: formData.get('ownerName')
            };

            fetch('/api/cats', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(catData),
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                alert('Cat added successfully!');
                fetchCats(); // Refresh the cat list
                this.reset(); // Clear the form fields
            })
            .catch(error => {
                console.error('Error adding cat:', error);
                alert(`Failed to add cat: ${error.message}`);
            });
        });

        // Add event listener to form for searching cats
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const ownerName = document.getElementById('searchOwnerName').value;
            fetchCats(ownerName);
        });
    </script>
</body>
</html>