

<!DOCTYPE html>
<html>
<head><title>Quiz</title></head>
<body>
<form method="post">
    <?php while ($row = $result->fetch_assoc()): ?>
        <fieldset>
            <legend><?php echo $row['question']; ?></legend>
            <?php foreach (json_decode($row['options']) as $index => $option): ?>
                <label>
                    <input type="radio" name="<?php echo $row['id']; ?>" value="<?php echo $index; ?>">
                    <?php echo $option; ?>
                </label><br>
            <?php endforeach; ?>
        </fieldset>
    <?php endwhile; ?>
    <button type="submit">Submit</button>
</form>
</body>
</html>
