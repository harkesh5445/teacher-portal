document.getElementById('addstudent').addEventListener('submit', async function(event) {
    event.preventDefault();
 //  window.alert("add");
    const name = document.getElementById('name').value;
    const subject = document.getElementById('subject').value;
    const marks = document.getElementById('marks').value;

    if (!name || !subject || !marks) {
        alert('Please fill in all fields');
        return;
    }

    try {
        const response = await fetch('../ajax/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name, subject,marks}),
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const result = await response.json();
          console.log(result);
        if (result.status === true) {
            alert('Success: ' + result.message);
            location.reload();
          //  document.getElementById("addstudent").reset();
        } else {
            alert('failed: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    }
});


function update(e, id) {
    var sname = e.name;
    var columnName = sname.substring(1);
    var columnValue = e.value;

    var data = {
        id: id,
        column: columnName,
        value: columnValue
    };

    fetch('../ajax/edit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === true) {
            console.log('Success: '+result.message);
        } else {
            alert('Failed: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function deletestu(id) {
   
    var data = {
        id: id
     };

    fetch('../ajax/delete', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === true) {
            alert('Success: '+result.message);
            location.reload();
        } else {
            alert('Failed: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function edit(id){
    document.getElementById('name'+id).readOnly = false;
    document.getElementById('subject'+id).readOnly = false;
    document.getElementById('marks'+id).readOnly = false;
   this.focus();
}
