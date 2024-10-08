
<style>
        .dropdown {
            position: relative;
            display: inline-block;
            width: 200px;
        }

        .dropdown-button {
            padding: 10px;
            border: 1px solid #ccc;
            cursor: pointer;
            background-color: #fff;
            text-align: left;
        }

        .dropdown-list {
            display: none; /* Hidden by default */
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            z-index: 1;
            width: 100%;
            max-height: 150px; /* Set max height for dropdown */
            overflow-y: auto; /* Enable scrolling */
        }

        .dropdown-list label {
            display: block;
            padding: 8px;
            cursor: pointer;
        }

        .dropdown-list label:hover {
            background-color: #f0f0f0; /* Highlight on hover */
        }

        .dropdown-list input {
            margin-right: 10px;
        }

    </style>
</head>
<body>

    <h1>Select Your Favorite Fruits</h1>
    <div class="dropdown">
        <div class="dropdown-button" id="dropdown-button">Select Fruits</div>
        <div class="dropdown-list" id="dropdown-list">
            <label><input type="checkbox" value="Apple"> Apple</label>
            <label><input type="checkbox" value="Banana"> Banana</label>
            <label><input type="checkbox" value="Cherry"> Cherry</label>
            <label><input type="checkbox" value="Date"> Date</label>
            <label><input type="checkbox" value="Elderberry"> Elderberry</label>
        </div>
    </div>

    <button id="add-button">Add to Table</button>

    <table id="fruit-table">
        <thead>
            <tr>
                <th>Selected Fruits</th>
            </tr>
        </thead>
        <tbody>
            <!-- Selected fruits will appear here -->
        </tbody>
    </table>

    <script>
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownList = document.getElementById('dropdown-list');
        const addButton = document.getElementById('add-button');
        const fruitTableBody = document.getElementById('fruit-table').getElementsByTagName('tbody')[0];

        // Toggle dropdown visibility
        dropdownButton.addEventListener('click', () => {
            dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
        });

        // Close the dropdown when clicking outside
        window.addEventListener('click', (event) => {
            if (!event.target.matches('.dropdown-button') && !dropdownList.contains(event.target)) {
                dropdownList.style.display = 'none';
            }
        });

        // Add selected fruits to the table
        addButton.addEventListener('click', () => {
            const selectedFruits = Array.from(dropdownList.querySelectorAll('input:checked')).map(input => input.value);
            selectedFruits.forEach(fruit => {
                const row = fruitTableBody.insertRow();
                const cell = row.insertCell(0);
                cell.textContent = fruit;
            });
            // dropdownList.style.display = 'none'; // Uncomment if you want to close the dropdown after adding
            dropdownList.querySelectorAll('input:checked').forEach(input => input.checked = false); // Clear selections
        });
    </script>

</body>
</html>
