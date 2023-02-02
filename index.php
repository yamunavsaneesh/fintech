<?php
include 'config.php';
require 'Classes/Accounts.php';
$objAccount = new Accounts();
$accounts = $objAccount->getLists();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FINANCIAL TRANSACTION SYSTEM</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="main.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="menu">
            <ul>
                <li class="logo"><img src="logo.png" alt="logo" width="40"></li>
                <li class="menu-item">FINANCIAL TRANSACTION SYSTEM</li>
            </ul>
        </div>
    </header>
    <section>
        <div class="row">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-end">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">Accounts</li>
                    </ol>
                </nav>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-dark btn-sm" href="newTransaction.php">New Transaction</a>
            </div>
        </div>
        <h2>ACCOUNTS</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Account Name</th>
                    <th scope="col">Account Number</th>
                    <th scope="col">Opening Balance</th>
                    <th scope="col">Last Transaction Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($accounts) foreach ($accounts as $key => $account) : ?>
                    <tr>
                        <th scope="row"><?php echo ++$key; ?></th>
                        <td><a href="transactions.php?account=<?php echo $account['AccountNumber']; ?>"><?php echo $account['AccountName']; ?></a></td>
                        <td><?php echo $account['AccountNumber']; ?></td>
                        <td>$ <?php echo  $account['OpeningBalance']; ?></td>
                        <td><?php echo date("d/m/Y H:i A", strtotime($account['ModifiedDate'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <!-- FOOTER: DEBUG INFO + COPYRIGHTS -->
    <footer>
        <div class="copyrights">
            <p>&copy; <?php echo date('Y') ?> Financial transactions system</p>
        </div>
    </footer>
</body>

</html>