<div>
    <style>
        /* The modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 35%;
        }

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

    <style>
        .checkbox {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 16px;
            user-select: none;
        }

        .checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #c6b0b0;
        }

        .checkbox input:checked~.checkmark {
            background-color: #2196F3;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox input:checked~.checkmark:after {
            display: block;
        }

        .checkbox .checkmark:after {
            left: 7px;
            top: 3px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }
    </style>



    <!-- The modal -->
    <div id="myModalEdit" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModalEdit()">&times;</span>
            <div class="form">
                <form action="/tasks/edit" method="POST">
                    @csrf
                    @method('PUT')
                    <h2>Add Task</h2>
                    <p>Please fill out the following information:</p>
                    <input type="hidden" id='id-of-task' name="id">
                    <label for="event-title">Title:</label>
                    <input type="text" id="event-title-edit" name="title" required>

                    <label for="event-description">Description:</label>
                    <textarea id="event-description-edit" name="description"></textarea>

                    <label for="event-date">Due Date:</label>
                    <input type="date" id="event-date-edit" name="due_date" min="">

                    <label class="checkbox">
                        <input type="checkbox" id="is-completed" name="completed">
                        <span class="checkmark"></span>
                        Is Completed
                    </label>

                    <button type="submit">Update</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        // get today's date
        const today1 = new Date().toISOString().split('T')[0];
        // set the min attribute of the date input field to today's date
        document.getElementById("event-date").setAttribute("min", today1);
    </script>

    <script>
        var tasks = {!! json_encode($tasks) !!};
		// Get the modal
		var modalEdit = document.getElementById("myModalEdit");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal
		function openModalEdit(id) {
            tasks.forEach(element => {
                if(element.id === id){
                    const eventTitle = document.getElementById('event-title-edit');
                    eventTitle.value = element.title;
                    const eventDescription = document.getElementById('event-description-edit');
                    eventDescription.value = element.description;
                    const eventDate = document.getElementById('event-date-edit');
                    eventDate.value = element.due_date;
                    const taskID = document.getElementById('id-of-task');
                    taskID.value = element.id;
                    const isCompleted = document.getElementById('is-completed');
                    if(element.completed == 1){
                        isCompleted.checked  = true;
                    }
                    else{
                        isCompleted.checked  = false;
                    }
                }
            });
			modalEdit.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		function closeModalEdit() {
			modalEdit.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modalEdit) {
				modalEdit.style.display = "none";
			}
		}
    </script>
</div>