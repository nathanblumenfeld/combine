<?php
include("includes/init.php");
$title = "Home";
$nav_home_class = "current_page";

// open connection to database
include_once("includes/db.php");
$db = open_sqlite_db("db/combine-database.sqlite");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all" />
  <title><?php echo $title; ?></title>
</head>

<body class="body-box">
  <!-- SIDEBAR -->
  <div class="sidebar">
    <!-- title pushed to top-->
    <div class="sidebar-section">
      <h1 class="sidebar-item">combine</h1>
      <!-- main nav -->
      <ul class="sidebar-item">
        <li><a class="sidebar-item" href=/home>leaderboard</a></li>
        <li><a class="sidebar-item" href=/help>help</a></li>
      </ul>
    </div>

    <!-- Filter Inputs -->
    <div class="sidebar-section">
      <h2 class="sidebar-item">filter</h2>
      <form class="operations-section" id="filter" name="filter" method="get" action="/home" novalidate>
        <!-- By Position -->
        <p class="sidebar-item">by position</p>
        <fieldset class="operations-item">
          <label><input name="RB" type="checkbox" value="1">RB</label>
          <label><input name="QB" type="checkbox" value="1">QB</label>
          <label><input name="TE" type="checkbox" value="1">TE</label>
          <label><input name="WR" type="checkbox" value="1">WR</label>
          <label><input name="FB" type="checkbox" value="1">FB</label>
          <label><input name="OL" type="checkbox" value="1">OL</label>
          <label><input name="DL" type="checkbox" value="1">DL</label>
          <label><input name="LB" type="checkbox" value="1">LB</label>
          <label><input name="S" type="checkbox" value="1">S</label>
          <label><input name="DB" type="checkbox" value="1">DB</label>
          <label><input name="KP" type="checkbox" value="1">K/P</label>
        </fieldset>
        <!-- By College -->
        <fieldset class="operations-item">
          <label>by college<input type="search" list="colleges" name="filter-college"></label>
          <datalist id="colleges">
            <option value="Brown">
            <option value="Columbia">
            <option value="Cornell">
            <option value="Dartmouth">
            <option value="Harvard">
            <option value="Penn">
            <option value="Princeton">
            <option value="Yale">
          </datalist>
          <div class="operations-item">
            <button type="submit">apply</button>
            <a href="/home"><button class="reset-button" type="button">reset</button></a>
          </div>
        </fieldset>
      </form>
    </div>

    <!-- Search Inputs -->
    <div class="sidebar-section">
      <h2 class="sidebar-item">player search</h2>
      <form class="operations-section" method="get" action="/home" novalidate>
        <fieldset class="operations-item">
          <label>name: <input type="search" id="search" name="search" required></label>
          <button type="submit">search</button>
        </fieldset>
      </form>
    </div>

    <!-- Insert Inputs -->
    <div class="sidebar-section">
      <h2 class="sidebar-item">insert player</h2>
      <form class="operations-section" method="post" action="/home" novalidate>
        <fieldset class="operations-item">
          <label>first name: <input type="text" id="first_name" name="first_name" required></label>
          <label>last name: <input type="text" id="last_name" name="last_name" required></label>
          <button type="submit" name="insert_player">insert player</button>
        </fieldset>
      </form>
    </div>

    <!-- Footer -->
    <div class="sidebar-section">
      <p class="sidebar-item">created by Nathan Blumenfeld<br>for INFO 2300</p>
    </div>
  </div>
  <!-- END SIDEBAR -->

  <?php
  // SORT
  $sort = $_GET["sort"]; // untrusted
  $sort_url = "/home?";
  $base_query = "SELECT first_name, last_name, college, position, forty_yard_time, wonderlic, bench_reps, vertical_jump, broad_jump, shuttle_time, three_cone_time, ROW_NUMBER() OVER (ORDER BY ";
  if (empty($sort)) {
    $has_sort = FALSE;
  } else {
    $has_sort = TRUE;
  }

  // which field to sort
  if ($sort == 'name') {
    $sql_query = $base_query . 'last_name ASC) AS row_number_rank FROM results ORDER BY last_name ASC';
  } elseif ($sort == 'position') {
    $sql_query = $base_query . 'position DESC) AS row_number_rank FROM results ORDER BY position DESC';
  } elseif ($sort == 'college') {
    $sql_query = $base_query . 'college ASC) AS row_number_rank FROM results ORDER BY college ASC';
  } elseif ($sort == 'forty-yard') {
    $sql_query = $base_query . 'forty_yard_time ASC) AS row_number_rank FROM results ORDER BY forty_yard_time ASC';
  } elseif ($sort == 'wonderlic') {
    $sql_query = $base_query . 'wonderlic DESC) AS row_number_rank FROM results ORDER BY wonderlic DESC';
  } elseif ($sort == 'bench') {
    $sql_query = $base_query . 'bench_reps DESC) AS row_number_rank FROM results ORDER BY bench_reps DESC';
  } elseif ($sort == 'vert') {
    $sql_query = $base_query . 'vertical_jump DESC) AS row_number_rank FROM results ORDER BY vertical_jump DESC';
  } elseif ($sort == 'broad') {
    $sql_query = $base_query . 'broad_jump DESC) AS row_number_rank FROM results ORDER BY broad_jump DESC';
  } elseif ($sort == 'shuttle') {
    $sql_query = $base_query . 'shuttle_time DESC) AS row_number_rank FROM results ORDER BY shuttle_time DESC';
  } elseif ($sort == '3-cone') {
    $sql_query = $base_query . 'three_cone_time DESC) AS row_number_rank FROM results ORDER BY three_cone_time DESC';
  }

  // FILTER
  $filter_RB = (bool)$_GET['RB']; // untrusted
  $filter_QB = (bool)$_GET['QB']; // untrusted
  $filter_TE = (bool)$_GET['TE']; // untrusted
  $filter_WR = (bool)$_GET['WR']; // untrusted
  $filter_FB = (bool)$_GET['FB']; // untrusted
  $filter_OL = (bool)$_GET['OL']; // untrusted
  $filter_DL = (bool)$_GET['DL']; // untrusted
  $filter_LB = (bool)$_GET['LB']; // untrusted
  $filter_S = (bool)$_GET['S']; // untrusted
  $filter_DB = (bool)$_GET['DB']; // untrusted
  $filter_KP = (bool)$_GET['KP']; // untrusted
  $filter_college = $_GET['filter-college']; // untrusted
  $base_query = "SELECT first_name, last_name, college, position, forty_yard_time, wonderlic, bench_reps, vertical_jump, broad_jump, shuttle_time, three_cone_time, ROW_NUMBER() OVER (ORDER BY forty_yard_time) AS row_number_rank FROM results WHERE";
  $has_filter_college = FALSE;
  $has_filter_pos = FALSE;

  if ($filter_RB || $filter_QB || $filter_WR || $filter_TE || $filter_FB || $filter_OL || $filter_DL || $filter_LB || $filter_DB || $filter_S || $filter_KP) {
    if ($filter_RB) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'RB'";
      $has_filter_pos = TRUE;
    }
    if ($filter_QB) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'QB'";
      $has_filter_pos = TRUE;
    }
    if ($filter_TE) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'TE'";
      $has_filter_pos = TRUE;
    }
    if ($filter_WR) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'WR'";
    }
    $has_filter = TRUE;
    if ($filter_FB) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'FB'";
      $has_filter_pos = TRUE;
    }
    if ($filter_OL) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'OL'";
      $has_filter_pos = TRUE;
    }
    if ($filter_DL) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'DL'";
      $has_filter_pos = TRUE;
    }
    if ($filter_LB) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'LB'";
      $has_filter_pos = TRUE;
    }
    if ($filter_DB) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'DB'";
      $has_filter_pos = TRUE;
    }
    if ($filter_S) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'S'";
      $has_filter_pos = TRUE;
    }
    if ($filter_KP) {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " OR ";
      }
      $filter_expr = $filter_expr . "position = 'K' OR position = 'P'";
      $has_filter_pos = TRUE;
    }
    $filter_expr = "(" . $filter_expr . ")";
  }

  if (!empty($filter_college)) {
    $has_filter_college = TRUE;
    if ($filter_college == 'Brown') {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " AND ";
      }
      $filter_expr = $filter_expr . "(college = 'Brown')";
    }
    if ($filter_college == 'Cornell') {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " AND ";
      }
      $filter_expr = $filter_expr . "(college = 'Cornell')";
    }
    if ($filter_college == 'Columbia') {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " AND ";
      }
      $filter_expr = $filter_expr . "(college = 'Columbia')";
    }
    if ($filter_college == 'Dartmouth') {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " AND ";
      }
      $filter_expr = $filter_expr . "(college = 'Dartmouth')";
    }
    if ($filter_college == 'Harvard') {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " AND ";
      }
      $filter_expr = $filter_expr . "(college = 'Harvard')";
    }
    if ($filter_college == 'Penn') {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " AND ";
      }
      $filter_expr = $filter_expr . "(college = 'Penn')";
    }
    if ($filter_college == 'Princeton') {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " AND ";
      }
      $filter_expr = $filter_expr . "(college = 'Princeton')";
    }
    if ($filter_college == 'Yale') {
      if ($has_filter_pos) {
        $filter_expr = $filter_expr . " AND ";
      }
      $filter_expr = $filter_expr . "(college = 'Yale')";
    }
  }

  if (!$has_sort && ($has_filter_college || $has_filter_pos)) {
    $sql_query = $base_query . $filter_expr;
  }

  if (!$has_sort && !($has_filter_college || $has_filter_pos)) {
    $sql_query = "SELECT first_name, last_name, college, position, forty_yard_time, wonderlic, bench_reps, vertical_jump, broad_jump, shuttle_time, three_cone_time, ROW_NUMBER() OVER (ORDER BY forty_yard_time ASC) AS row_number_rank FROM results";
  }

  if ($has_sort && ($has_filter_college || $has_filter_pos)) {
    $sql_query = $base_query . $filter_expr;
  }
  // SEARCH
  $search_input = trim($_GET["search"]); // untrusted
  $sql_search_array = array();

  if (empty($search_input)) {
    $search_input = NULL;
  } else {
    $base_query = "SELECT first_name, last_name, college, position, forty_yard_time, wonderlic, bench_reps, vertical_jump, broad_jump, shuttle_time, three_cone_time, ROW_NUMBER() OVER (ORDER BY forty_yard_time) AS row_number_rank FROM results WHERE ";
    $search_array[":search_input"] = $search_input;
    $sql_query = $base_query . "((last_name LIKE '%' || :search_input || '%') OR (first_name LIKE '%' || :search_input || '%'))";
    $sql_search_array[":search_input"] = $search_input;
  }

  // INSERT
  if (isset($_POST['insert_player'])) {
    $first_name = trim($_POST['first_name']); // untrusted
    $last_name = trim($_POST['last_name']); // untrusted
    $form_valid = True;

    // first_name required
    if (empty($first_name)) {
      $form_valid = False;
      if (!is_string($first_name)) {
        $form_valid = False;
      }
    }

    // last_name required
    if (empty($last_name)) {
      $form_valid = False;
      if (!is_string($last_name)) {
        $form_valid = False;
      }
    }
  }

  if ($form_valid) {
    $result = exec_sql_query(
      $db,
      "INSERT INTO results (first_name, last_name) VALUES (:first_name, :last_name);",
      array(
        ':first_name' => $first_name,
        ':last_name' => $last_name,
      )
    );
  }
  ?>

  <!-- TABLE -->
  <section>
    <table class='table-box'>
      <tr>
        <th class="text-align-left">Rk.</th>
        <th class="text-align-left"><a href="<?php echo $sort_url . "sort=name"; ?>"><button>Name</button></a></th>
        <th class="text-align-left"><a href="<?php echo $sort_url . "sort=college"; ?>"><button>College</button></a></th>
        <th class="text-align-right"><a href="<?php echo $sort_url . "sort=position"; ?>"><button>Pos.</button></a></th>
        <th class="text-align-right"><a href="<?php echo $sort_url . "sort=forty-yard"; ?>"><button>40 Yrd.</button></a></th>
        <th class="text-align-right"><a href="<?php echo $sort_url . "sort=wonderlic"; ?>"><button>Wonderlic</button></a></th>
        <th class="text-align-right"><a href="<?php echo $sort_url . "sort=bench"; ?>"><button>Bench Reps</button></a></th>
        <th class="text-align-right"><a href="<?php echo $sort_url . "sort=vert"; ?>"><button>Vert.</button></a></th>
        <th class="text-align-right"><a href="<?php echo $sort_url . "sort=broad"; ?>"><button>Broad</button></a></th>
        <th class="text-align-right"><a href="<?php echo $sort_url . "sort=shuttle"; ?>"><button>Shuttle</button></a></th>
        <th class="text-align-right"><a href="<?php echo $sort_url . "sort=3-cone"; ?>"><button>3 Cone</button></a></th>
      </tr>

      <?php
      // query the database for records
      $records = exec_sql_query(
        $db,
        $sql_query,
        $sql_search_array
      )->fetchAll();

      foreach ($records as $record) { ?>
        <tr>
          <td class="text-align-left"><?php echo htmlspecialchars($record["row_number_rank"]); ?></td>
          <td class="text-align-left"><?php echo htmlspecialchars(($record["first_name"] . " " . $record["last_name"])); ?></td>
          <td class="text-align-left"><?php echo htmlspecialchars($record["college"]); ?></td>
          <td class="text-align-right"><?php echo htmlspecialchars($record["position"]); ?></td>
          <td class="text-align-right"><?php echo htmlspecialchars($record["forty_yard_time"]); ?></td>
          <td class="text-align-right"><?php echo htmlspecialchars($record["wonderlic"]); ?></td>
          <td class="text-align-right"><?php echo htmlspecialchars($record["bench_reps"]); ?></td>
          <td class="text-align-right"><?php echo htmlspecialchars($record["vertical_jump"]); ?></td>
          <td class="text-align-right"><?php echo htmlspecialchars($record["broad_jump"]); ?></td>
          <td class="text-align-right"><?php echo htmlspecialchars($record["shuttle_time"]); ?></td>
          <td class="text-align-right"><?php echo htmlspecialchars($record["three_cone_time"]); ?></td>
        </tr>
      <?php } ?>
    </table>
  </section>
  <!-- END TABLE -->
</body>

</html>
