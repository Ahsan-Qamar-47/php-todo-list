<?php
include 'includes/db.php';

// Handle filter
$where = '';
$filter = '';
if (isset($_GET['filter'])) {
  $filter = $_GET['filter'];
  if ($filter === 'done') {
    $where = 'WHERE is_done = 1';
  } elseif ($filter === 'todo') {
    $where = 'WHERE is_done = 0';
  }
}

$result = $conn->query("SELECT * FROM tasks $where ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>To-Do List</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <h2>My To-Do List</h2>

    <form action="actions/add.php" method="POST">
      <input type="text" name="title" placeholder="Enter new task..." required>
      <button type="submit">Add</button>
    </form>

    <div class="filters">
      <a href="index.php" class="<?php echo $filter === '' ? 'active' : ''; ?>">All</a>
      <a href="index.php?filter=todo" class="<?php echo $filter === 'todo' ? 'active' : ''; ?>">To-Do</a>
      <a href="index.php?filter=done" class="<?php echo $filter === 'done' ? 'active' : ''; ?>">Done</a>
    </div>


    <ul>
      <?php while ($row = $result->fetch_assoc()): ?>
        <li class="<?php echo $row['is_done'] ? 'done' : ''; ?>">
          <div class="task-info">
            <span><?php echo htmlspecialchars($row['title']); ?></span>
            <small><?php echo date('M d, H:i', strtotime($row['created_at'])); ?></small>
          </div>
          <div class="actions">
            <a href="actions/toggle.php?id=<?php echo $row['id']; ?>">
              <?php echo $row['is_done'] ? 'Undo' : 'Done'; ?>
            </a>
            <a href="actions/delete.php?id=<?php echo $row['id']; ?>" class="delete">Delete</a>
          </div>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
</body>

</html>