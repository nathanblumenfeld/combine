<div class="sidebar">
  <!-- title pushed to top-->
  <div class="sidebar-section">
    <h1 class="sidebar-item">combine</h1>
    <!-- main nav tree -->
    <ul class="sidebar-item">
      <li><a class="sidebar-item" href=/home>leaderboard</a></li>
      <li><a class="sidebar-item" href=/about>about</a></li>
      <li><a class="sidebar-item" href=/help>help</a>
      </li>
    </ul>
  </div>

  <!-- NEW FLEXBOX -->
  <div class="sidebar-section">
    <!-- Filter -->
    <h2 class="sidebar-item">Filter</h2>
    <form class="sidebar-item " id="filter" name="filter" method="get">
      <!-- By Position -->
      <h3 class="sidebar-item">by position</h3>
      <fieldset class="sidebar-item">
        <input type="checkbox" value="all" selected>all
        <br>
        <input type="checkbox" value="RB">RB
        <input type="checkbox" value="QB">QB
        <input type="checkbox" value="TE">TE
        <input type="checkbox" value="WR">WR
        <input type="checkbox" value="FB">FB
        <input type="checkbox" value="OL">OL
        <br>
        <input type="checkbox" value="DL">DL
        <input type="checkbox" value="LB">LB
        <input type="checkbox" value="S">S
        <input type="checkbox" value="DB">DB
        <input type="checkbox" value="K">K
      </fieldset>
      <!-- By College -->
      <h3 class="sidebar-item">by college</h3>
      <fieldset class="sidebar-item">
        <input list="colleges" name="college">
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
      </fieldset>
      <input type="submit">
      <button class=sidebar-item type="button">Reset Filters</button>
    </form>
  </div>

  <div class="sidebar-section">
    <!-- Search -->
    <h2 class="sidebar-item">Search for Player</h2>
    <form method="get">
      <label for="fname">Name:</label>
      <input type="text" id="name" name="name"> <br>
      <input type="submit">
    </form>
  </div>
  <!-- Footer -->
  <div class="sidebar-section">
    <p class="sidebar-item">created by Nathan Blumenfeld<br>for INFO 2300</p>
  </div>
</div>
