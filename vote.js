document.addEventListener('DOMContentLoaded', function() {
    const electionId = 1; // ID for the student council election

    // Function to fetch candidates from the server
    function fetchCandidates() {
        fetch(`fetch_candidates.php?election_id=${electionId}`)
            .then(response => response.json())
            .then(data => {
                const form = document.getElementById('vote-form');
                form.innerHTML = ''; // Clear the form

                if (data.length === 0) {
                    form.innerHTML = '<p>No candidates available.</p>';
                    return;
                }

                data.forEach(candidate => {
                    const label = document.createElement('label');
                    label.innerHTML = `
                        <input type="radio" name="candidate_id" value="${candidate.id}" required>
                        ${candidate.name} - ${candidate.description}
                    `;
                    form.appendChild(label);
                    form.appendChild(document.createElement('br'));
                });

                const submitButton = document.createElement('button');
                submitButton.type = 'submit';
                submitButton.textContent = 'Vote';
                form.appendChild(submitButton);
            })
            .catch(error => {
                console.error('Error fetching candidates:', error);
            });
    }

    // Function to handle form submission
    function handleFormSubmission(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(event.target);
        fetch('vote.php', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
            },
        })
        .then(response => response.text())
        .then(result => {
            alert(result); // Display the result to the user
        })
        .catch(error => {
            console.error('Error submitting vote:', error);
        });
    }

    // Initialize the page
    fetchCandidates();

    // Attach event listener for form submission
    const voteForm = document.getElementById('vote-form');
    if (voteForm) {
        voteForm.addEventListener('submit', handleFormSubmission);
    }
});
