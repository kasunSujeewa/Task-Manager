<div>
    <style>
                table {
        font-family: Arial, sans-serif;
        border-collapse: collapse;
        width: 70%;
        margin: 2% 14%;
        }

        th, td {
        text-align: left;
        padding: 8px;
        }

        th {
        background-color: #4CAF50;
        color: white;
        text-align: center;
        }

        tr:nth-child(even) {
        background-color: #f2f2f2;
        }

        #searchInput {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        width: 70%;
        margin: 2% 14%;
        }
        td:first-child {
        width: 15%; /* set the first column width to 30% */
        }
        td:nth-child(2) {
        width: 30%; /* set the second column width to 30% */
        text-align: center;
        }
        td:nth-child(3) {
        width: 15%; /* set the second column width to 30% */
        text-align: center;
        }
        td:nth-child(4) {
        width: 15%; /* set the second column width to 30% */
        text-align: center;
        }
        td:nth-child(5) {
        width: 15%; /* set the second column width to 30% */
        text-align: center;
        }

    </style>
    <style>
      #delete-btn {
        background-color: red;
        color: white;
        padding: 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

    .delete-btn.confirm {
      background-color: gray;
    }
    #my-form{
      padding: 2px;
      border: none;
      background: none;
    }
    .edit-btn {
        background-color: rgb(12, 31, 173);
        color: white;
        padding: 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

    </style>
    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search...">
        <table id="myTable">
        <thead>
            <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Availability</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $t)
            <tr>
                <td>{{$t->title}}</td>
                <td>{{$t->description}}</td>
                <td>{{$t->due_date}}</td>
                @if($today > $t->due_date)
                <td>Overdue Task</td>
                @else
                <td>Active Task</td>
                @endif
                @if($t->completed)
                <td>Completed</td>
                @else
                <td>In progress</td>
                @endif
                <td>
                  <button  class="edit-btn"  onclick="openModalEdit({{$t->id}})">Edit</button>
                </td>
                <td>
                  <form id="my-form" action="/task/delete" method="post">
                  @method('DELETE')
                  @csrf
                    <input type="hidden" name="id" value="{{$t->id}}" />
                    <button type="submit" id="delete-btn" class="delete-btn">Delete</button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
<script>
    function filterTable() {
      // Declare variables
      var input, filter, table, tr, td, i, j, txtValue;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those that don't match the search query
      for (i = 0; i < tr.length; i++) {
        for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
          td = tr[i].getElementsByTagName("td")[j];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
              break;
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }
}

</script>
<script>
   const form = document.getElementById('my-form');
    const deleteBtn = form.querySelector('.delete-btn');

    deleteBtn.addEventListener('click', function(event) {
      event.preventDefault(); // prevent the form from submitting immediately
      deleteBtn.classList.add('confirm');
      const confirmed = confirm('Are you sure you want to delete this item?');
      if (!confirmed) {
        deleteBtn.classList.remove('confirm');
      } else {
        form.submit(); // submit the form
      }
    });

</script>
</div>