<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.min.css">
 <!-- Anti Back-Forward Cache (BFCache) Javascript -->
    <script>
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #224abe);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 15px;
        }

        .login-title {
            font-weight: bold;
            color: #4e73df;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <h4 class="text-center login-title mb-4">Login</h4>

                    <div class="row mb-3">
                        <div class="col-12">
                            <?php Flasher::flash(); ?>
                        </div>
                    </div>

                    <form action="<?= BASEURL; ?>/login/proses" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                </div>
            </div>

            <p class="text-center text-white mt-3 small">
                © <?= date('Y'); ?> - Sistem Login PHPMVC
            </p>

        </div>
    </div>
</div>

</body>
</html>