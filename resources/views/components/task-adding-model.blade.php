<div>
    <style>
		/* The modal (background) */
		.modal {
			display: none; /* Hidden by default */
			position: fixed; /* Stay in place */
			z-index: 1; /* Sit on top */
			left: 0;
			top: 0;
			width: 100%; /* Full width */
			height: 100%; /* Full height */
			overflow: auto; /* Enable scroll if needed */
			background-color: rgba(0,0,0,0.4); /* Black with opacity */
		}
		
		/* Modal content */
		.modal-content {
			background-color: #fefefe;
			margin: 10% auto; /* 15% from the top and centered */
			padding: 20px;
			border: 1px solid #888;
			width: 35%; /* Could be more or less, depending on screen size */
		}
		
		/* Close button */
		.close {
			color: #aaa;
			float: right;
			font-size: 28px;
			font-weight: bold;
		}
		
		.close:hover,
		.close:focus {
			color: black;
			text-decoration: none;
			cursor: pointer;
		}
	</style>

    <style>
        form {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        }
        
        h2 {
        text-align: center;
        font-size: 24px;
        margin-top: 0;
        }
        
        label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        }
        
        input[type="text"],
        textarea,
        input[type="date"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
        font-size: 16px;
        }
        
        input[type="date"]::-webkit-inner-spin-button,
        input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
        }
        
        button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        }
        
        button[type="submit"]:hover {
        background-color: #45a049;
        }
        
        input[type="text"]:focus,
        textarea:focus,
        input[type="date"]:focus {
        border: 2px solid #4CAF50;
        }
        
    </style>

     <!-- The modal -->
     <div id="myModal" class="modal">
    
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="form">
                <form action="/tasks" method="POST">
                    @csrf
                    <h2>Add Task</h2>
                    <p>Please fill out the following information:</p>
                    
                    <label for="event-title">Title:</label>
                    <input type="text" id="event-title" name="title" required>
                    
                    <label for="event-description">Description:</label>
                    <textarea id="event-description" name="description"></textarea>
                    
                    <label for="event-date">Due Date:</label>
                    <input type="date" id="event-date" name="due_date" min="" >
                    
                    <button type="submit">Add</button>
                  </form>
            </div>
        </div>

    </div>

    <script>
        // get today's date
        const today = new Date().toISOString().split('T')[0];
        // set the min attribute of the date input field to today's date
        document.getElementById("event-date").setAttribute("min", today);
    </script>

	<script>
		// Get the modal
		var modal = document.getElementById("myModal");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal
		function openModal() {
			modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		function closeModal() {
			modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>
</div>