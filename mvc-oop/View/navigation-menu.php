<ul>
    <li><a href="dashboard.php">Dashboard</a></li>

    <!-- A DIRECT PAGE SHOULD HAVE A CONTROLLER LINK BY DEFAULT THEN THE 
CONTROLLERS DEFAULT METHOD WILL REDIRECT TO VIEW -->

    <?php if ($user_role == 'admin') : ?>
      <li><a href="users-management.php">Users Management</a></li>
      <li><a href="users-management-ajax-delete.php">Users Management(Ajax Delete)</a></li>
      <li><a href="products-management.php">Products Management</a></li>
      <li><a href="orders-management.php">Orders Management</a></li>
      <li><a href="orders-statistics.php">Orders Statistics</a></li>

    <?php elseif ($user_role == 'salesman') : ?>

      <li><a href="orders-management.php">Orders Management</a></li>

    <?php elseif ($user_role == 'customer') : ?>

      <li><a href='previous_transactions.php'>Previous Transactions</a></li>
      <li><a href='transaction_statistics.php'>Transaction Statistics</a></li>

    <?php endif; ?>

    <li><a href="logout.php">Logout</a></li>
  </ul>