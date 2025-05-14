<!DOCTYPE html>
<html>
<head>
    <title>PHP Assessment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #92bf34;
            color: white;
            font-weight: bold;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    </style>
</head>
<body class="py-5">

<div class="container">
    <div class="row justify-content-center">

        <!-- Input Card -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">Enter Sequence</div>
                <div class="card-body">
                    <p class="text-muted">Paste your sequence below (one per line):</p>
                    <form id="sequenceForm" method="POST" >
                        <textarea id="sequenceInput" name="sequenceInput" class="form-control mb-3" rows="10" placeholder="e.g.&#10;1.1&#10;1.2&#10;1.3.1"></textarea>
                 
                    <div class="text-end">
                        <button id="submitBtn" type="button" class="btn btn-success">Correct & Show Chart</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

      
        <div class="col-lg-10" id="chartArea" style="display:none;">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Corrected Sequence Chart</span>
                    <button id="downloadCSV" class="btn btn-outline-light btn-sm"> Download CSV</button>
                </div>
                <div class="card-body">
                    <canvas id="sequenceChart" height="100"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
 <script src="main.js"></script>
</body>
</html>
