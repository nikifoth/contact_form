	<!--- contact page -->
	<div class="contact-page">
			<div class="header">
				<h1>contact</h1>
			</div>
		<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST'):
			$errors = 0;
			// name field
			if (isset($_POST['name'])) {
				$name = $_POST['name'];

				if (strlen($_POST['name']) < 3) {
					$nameErr = true;
					$errors++;
				}	
			}
			else {
				$nameErr = true;
				$errors++;
			}
			// email field
			if (isset($_POST['email'])) {
				$email = $_POST['email'];

				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailErr = true;
					$errors++;
				}
			}
			else {
				$emailErr = true;
				$errors++;
			}
			// message field
			if (isset($_POST['message'])) {
				$message = $_POST['message'];

				if (strlen($_POST['message']) < 8) {
					$messageErr = true;
					$errors++;
				}
			}
			else {
				$messageErr = true;
				$errors++;
			}

			if ($errors < 1) {
				$formcontent="From: $name \n Message: $message";
				$recipient = "nikifoth@icloud.com";
				$subject = "Contact Form";
				$mailheader = "From: $email \r\n";
				mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");

				echo '<p class="thankyou-message">Thanks for your message, I will get back to you as soon as I can.</p>';
			} else {
				echo '<p class="error-message">There was a problem with your submission, please check the highlighted fields and resubmit.</p>';
			}

			endif; ?>
			<form class="form" action="/contact" method="POST">
				<p class="name">
					<input <?php if (isset($nameErr)) { echo 'class="error" '; } ?>type="text" name="name" id="name" placeholder="Your name" value="<?php if (isset($name)) { echo $name; } ?>" required />
					<label for="name"<?php if (isset($nameErr)) { echo 'class="error"'; } ?>>Name</label>
				</p>
				<p class="email">
					<input <?php if (isset($emailErr)) { echo 'class="error" '; } ?>type="email" name="email" id="email" placeholder="Your email address" value="<?php if (isset($email)) { echo $email; } ?>" required />
					<label for="email">Email</label>
				</p>
				<p class="text">
					<textarea <?php if (isset($messageErr)) { echo 'class="error" '; } ?>name="message" placeholder="Type your message here" required><?php if (isset($message)) { echo $message; } ?></textarea>
				</p>
				<p class="submit">
					<button type="submit">Send</button>
				</p>
			</form>
	    </div>