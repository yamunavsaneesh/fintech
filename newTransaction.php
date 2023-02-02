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
                        <li class="breadcrumb-item"><a href="index.php">Accounts</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Transaction</li>
                    </ol>
                </nav>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-dark btn-sm" href="index.php">All Accounts</a>
                <a class="btn btn-dark btn-sm" href="transactions.php">All Transactions</a>
            </div>
        </div>
        <h2>NEW TRANSACTION</h2>
        <div class="card">
            <div class="card-body p-5">
                <form action="saveTransaction.php" method="post">
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <p class="text-center h6">TRANSACTION DETAILS</p>
                            <div class="form-group">
                                <label for="transact" class="form-label">Transaction Type</label>
                                <select class="form-control transtype" name="TransactionType" required>
                                    <option value="">Select</option>
                                    <?php foreach (['Deposit', 'Withdrawal', 'Transfer'] as $val) : ?>
                                        <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="PaymentType" class="form-label">Cash/Cheque</label>
                                <select class="form-control" name="PaymentType" required>
                                    <option value="">Select</option>
                                    <?php foreach (['Cash', 'Cheque'] as $val) : ?>
                                        <option value="<?php echo $val; ?>"><?php echo ucfirst($val); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="AccountIDcr" class="form-label">Credit Account ID</label>
                                <input type="text" class="form-control" name="AccountIDcr" placeholder="Account Number" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="AccountIDdr" class="form-label">Debit Account ID</label>
                                <input type="text" class="form-control" name="AccountIDdr" placeholder="TransactionDate" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Amount" class="form-label">Amount</label>
                                <input type="text" class="form-control" name="Amount" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="DueDate" class="form-label">Due Date</label>
                                <input type="datetime-local" class="form-control" name="DueDate" placeholder="Account Number" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Comment" class="form-label">Comment</label>
                                <textarea class="form-control" name="Comment" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button class="w-100 btn btn-dark btn-md" type="submit">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- FOOTER: DEBUG INFO + COPYRIGHTS -->
    <footer>
        <div class="copyrights">
            <p>&copy; <?php echo date('Y') ?> Financial transactions system</p>
        </div>
    </footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(".transtype").change(function() {
        var o = $(this).val();
        if (o == 'Deposit') {
            $('input[name="AccountIDdr"]').val('CASH001');
            $('input[name="AccountIDcr"]').val('');
        } else if (o == 'Withdrawal') {
            $('input[name="AccountIDcr"]').val('CASH001');
            $('input[name="AccountIDdr"]').val('');
        } else {
            $('input[name="AccountIDdr"]').val('');
            $('input[name="AccountIDcr"]').val('');
        }
    });
</script>

</html>