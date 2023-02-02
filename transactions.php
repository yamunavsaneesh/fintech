<?php
include 'config.php';
require 'Classes/Accounts.php';
$objAccount = new Accounts();
$order = htmlspecialchars(isset($_GET["order"]) ? $_GET["order"] : '');
$accountno = htmlspecialchars(isset($_REQUEST["account"]) ? $_REQUEST["account"] : '');
$where = " AccountIDcr='$accountno' or AccountIDdr='$accountno' ";
$transactions = $objAccount->getTransactions($where, $order);
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
                        <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                    </ol>
                </nav>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-dark btn-sm" href="index.php">Accounts </a>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <h2>ALL TRANSACTIONS</h2>
            </div>
            <div class="col-4 text-end mt-4">
                <form action="" method="post">
                    <div class="d-flex justify-content-end">
                        <select class="form-select w-auto filter" name="account">
                            <option value="">Filter by Accounts</option>
                            <?php $a_data = [];
                            foreach ($accounts as $k => $account) : $a_data[$account['AccountNumber']] = $account; ?>
                                <option value="<?php echo $account['AccountNumber']; ?>" <?php echo $account['AccountNumber'] == $accountno ? 'selected' : '' ?>><?php echo $account['AccountNumber'] . ' - ' . $account['AccountName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button class="w-100 btn btn-dark btn-md" type="submit">GO</button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">Transaction Type</th>
                    <th scope="col"><a href="transactions.php?order=date&account=<?php echo $accountno ?>" class="text-success">Due Date</a></th>
                    <th scope="col"><a href="transactions.php?order=comment&account=<?php echo $accountno ?>" class="text-success">Comments</a></th>
                    <th scope="col" class="text-end">Credit</th>
                    <th scope="col" class="text-end">Debit</th>
                    <th scope="col" class="text-end">Balance</th>
                </tr>
            </thead>
            <tbody>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td class="fw-bold text-end">Opening Balance</td>
                <td class="text-end"></td>
                <td class="text-end"></td>
                <td class="text-end fw-bold">$ <?php echo $o_balance = $accountno ? $a_data[$accountno]['OpeningBalance'] : 0; ?></td>
                <?php $t_credit = $t_debit = 0;
                if ($transactions) foreach ($transactions as $key => $data) : $debit = $credit = 0;
                    if ($accountno == $data['AccountIDcr']) {
                        $credit = $data['Amount'];
                        $t_credit = $t_credit + $credit;
                        $o_balance = $o_balance + $credit;
                    } else if ($accountno == $data['AccountIDdr']) {
                        $debit = $data['Amount'];
                        $t_debit = $t_debit + $debit;
                        $o_balance = $o_balance - $debit;
                    }  ?>
                    <tr>
                        <th scope="row"><?php echo ++$key; ?></th>
                        <td><?php echo $data['PaymentType']; ?></td>
                        <td><?php echo $data['TransactionType']; ?></td>
                        <td><?php echo date("d/m/Y H:i A", strtotime($data['DueDate'])); ?></td>
                        <td><?php echo nl2br($data['Comment']); ?></td>
                        <td class="text-end">$ <?php echo $credit;  ?></td>
                        <td class="text-end">$ <?php echo $debit; ?></td>
                        <td class="text-end">$ <?php echo $o_balance ?></td>
                    </tr>
                <?php endforeach; ?> <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="fw-bold text-end">Available Balance</td>
                    <td class="text-end"> </td>
                    <td class="text-end"> </td>
                    <td class="text-end fw-bold">$ <?php echo $o_balance ?></td>
                </tr>
            </tbody>
        </table>
    </section>
    <footer>
        <div class="copyrights">
            <p>&copy; <?php echo date('Y') ?> Financial transactions system</p>
        </div>
    </footer>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(".filter").change(function() {
        var o = $(this).val();
        location.href
    });
</script>

</html>