<?php require "includes/header.php" ?>
<main>
  <h2>🎮 Order Game Items – Fast, Easy & Secure</h2>

  <form action="process.php" method="post" novalidate>

    <fieldset>
      <legend>Player Information</legend>

      <label for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name" required minlength="2">

      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" name="last_name" required minlength="2">

      <label for="phone">Phone Number</label>
      <input type="tel" id="phone" name="phone"
             placeholder="555-123-4567"
             pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>

      <label for="address">Shipping Address</label>
      <input type="text" id="address" name="address" required minlength="5">

      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required>
    </fieldset>

    <fieldset>
      <legend>Game Items</legend>

      <p>Select quantities (use 0 if you don’t want an item).</p>

      <table border="1" cellpadding="8">
        <thead>
          <tr>
            <th>Item</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $items = [
            "kingdom_hearts" => "Kingdom Hearts",
            "lies_p" => "Lies of P",
            "secret_mimic" => "Secret of the Mimic",
            "tears_kingdom" => "Tears of the Kingdom",
            "gzmo" => "Gizmo's Grand Adventure",
            "zech_kart" => "Zech Kart"
          ];

          foreach ($items as $key => $label): ?>
            <tr>
              <th scope="row"><?= $label ?></th>
              <td>
                <label for="<?= $key ?>" class="visually-hidden">
                  <?= $label ?> quantity
                </label>
                <input type="number"
                       id="<?= $key ?>"
                       name="items[<?= $key ?>]"
                       min="0"
                       max="99"
                       value="0">
              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </fieldset>

    <fieldset>
      <legend>Additional Notes</legend>

      <label for="comments">Notes (optional)</label>
      <textarea id="comments" name="comments" rows="4"
        placeholder="Character name, server, delivery notes..."></textarea>
    </fieldset>

    <p>
      <button type="submit">Submit Order</button>
    </p>

  </form>
</main>

<?php require "includes/footer.php" ?>
