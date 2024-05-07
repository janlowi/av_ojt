<?php
 session_start()
$filter_criteria = "challenges";

 
$sql = "SELECT * FROM reports WHERE status = :status";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':status' => $filter_criteria));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

 
?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
            
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $row): ?>
              <tr>
              <table class="table table-hover">
                <!-- Example: -->
                <td><?= $row['column_name'] ?></td>
                <td><?= $row['another_column'] ?></td>
                <!-- Continue with other columns -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>