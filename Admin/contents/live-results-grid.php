<style>
    /* ---------------------- */
    /* Base Light Mode (Default) */
    /* ---------------------- */

    .vote-card {
        border-radius: 1rem;
        padding: 20px;
        background-color: #ffffff;  
        color: #000000;
        transition: 0.3s ease;
        border: 1px solid #e0e0e0;
    }

    .vote-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .candidate-name {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .tag-green {
        background: #28a745;
        color: #ffffff;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .tag-gray {
        background: #6c757d;
        color: #ffffff;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .tag-blue {
        background: #0d6efd;
        color: #ffffff;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 11px;
    }

    .progress {
        height: 7px;
        border-radius: 10px;
        background-color: #e6e6e6;
        overflow: hidden;
        margin-top: 10px;
    }

    .progress-bar {
        transition: width 0.9s ease;
    }

    /* ---------------------- */
    /* DARK MODE (By class only) */
    /* ---------------------- */

    .dark-mode .vote-card {
        background-color: #181818 !important;
        color: #f5f5f5 !important;
        border: 1px solid #333;
    }

    .dark-mode .progress {
        background-color: #2c2c2c !important;
    }

</style>

</head>

<body>
<div class="content-page">
    <div class="content">
        <div class="container-fluid mt-3">

            <div class="container">
                <div class="row gy-4" id="voteRow">
                    <!-- Cards will be injected here by JavaScript -->
                </div>
            </div>

        </div>
    </div>
</div>

</div>
</div>
</div>
