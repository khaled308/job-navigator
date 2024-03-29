<?php require_once __DIR__ .  '/includes/head.php' ?>
<?php require_once __DIR__ .  '/includes/nav.php' ?>

    <!-- Post a Job Form Box -->
    <section class="flex justify-center items-center mt-20">
      <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Create Job Listing</h2>
        <?php if (isset($SESSION_SUCCESS)): ?>
            <div class="message bg-green-100 p-3 my-3">
              <?= $SESSION_SUCCESS ?>
            </div>
        <?php endif ?>
        <?php if (isset($SESSION_ERROR)): ?>
            <div class="message bg-red-100 p-3 my-3"><?= $SESSION_ERROR ?></div>
        <?php endif ?>
        <form method="POST">
          <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
            Job Info
          </h2>
          <?php if (isset($errors)): ?>
            <?php foreach($errors as $error): ?>
              <div class="message bg-red-100 px-4 my-3"><?= $error ?></div>
            <?php endforeach ?>
          <?php endif ?>
          <div class="mb-4">
            <input
              type="text"
              name="title"
              placeholder="Job Title"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['title'] ?? '' ?>"
            />
          </div>
          <div class="mb-4">
            <textarea
              name="description"
              placeholder="Job Description"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            ><?= $job['description'] ?? '' ?></textarea>
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="salary"
              placeholder="Annual Salary"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['salary'] ?? '' ?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="requirements"
              placeholder="Requirements"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['requirements'] ?? '' ?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="benefits"
              placeholder="Benefits"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['benefits'] ?? '' ?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="tags"
              placeholder="Tags"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['tags'] ?? '' ?>"
            />
          </div>
          <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
            Company Info & Location
          </h2>
          <div class="mb-4">
            <input
              type="text"
              name="company"
              placeholder="Company Name"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['company'] ?? '' ?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="address"
              placeholder="Address"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['address'] ?? '' ?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="city"
              placeholder="City"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['city'] ?? '' ?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="state"
              placeholder="State"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['state'] ?? '' ?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="phone"
              placeholder="Phone"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['phone'] ?? '' ?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="email"
              name="email"
              placeholder="Email Address For Applications"
              class="w-full px-4 py-2 border rounded focus:outline-none"
              value="<?= $job['email'] ?? '' ?>"
            />
          </div>
          <button
            class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
          >
            Save
          </button>
          <a
            href="/"
            class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none"
          >
            Cancel
          </a>
        </form>
      </div>
    </section>

    <!-- Bottom Banner -->
      <section class="container mx-auto my-6">
        <div class="bg-blue-800 text-white rounded p-4 flex items-center justify-between">
          <div>
            <h2 class="text-xl font-semibold">Looking to hire?</h2>
            <p class="text-gray-200 text-lg mt-2">
              Post your job listing now and find the perfect candidate.
            </p>
          </div>
          <a href="post-job.html" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300">
            <i class="fa fa-edit"></i> Post a Job
          </a>
        </div>
      </section>
  </body>
</html>
