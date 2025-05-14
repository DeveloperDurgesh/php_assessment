let correctedSequence = []; 


$('#sequenceForm').validate({
    rules: {
        sequenceInput: {
            required: true,
            minlength: 1
        }
    },
    messages: {
        sequenceInput: {
            required: "Please enter a sequence before submitting.",
            minlength: "Sequence cannot be empty."
        }
    },
    errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-control').after(error);
    }
});

$('#submitBtn').click(function (event) {
            event.preventDefault();
    if (!$('#sequenceForm').valid()) {
        return; 
    }

    const sequence = $('#sequenceInput').val().trim();

    $.ajax({
        url: 'process.php',
        type: 'POST',
        data: { sequence: sequence },
        dataType: 'json',
        success: function (response) {
            console.log('Labels:', response.data);
            if (response.status === 'success') {
                correctedSequence = response.data;
                const labels = correctedSequence;
                const values = labels.map(item => String(item).split('.').length);

                $('#chartArea').show();
                const ctx = document.getElementById('sequenceChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Hierarchy Depth',
                            data: values,
                            backgroundColor: '#92bf34'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Level: ' + context.raw;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: { ticks: { autoSkip: false } }
                        }
                    }
                });
            } else {
                alert('Error: ' + response.message);
            }
        }
    });
});


document.getElementById("downloadCSV").addEventListener("click", () => {
    if (correctedSequence.length === 0) return alert("No corrected data to download.");

    const csvContent = correctedSequence.join("\r\n");
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "corrected_sequence.csv";
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});