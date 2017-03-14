<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="./index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#postsDropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="postsDropdown" class="collapse">
                <li>
                    <a href="./posts.php">View all Posts</a>
                </li>
                <li>
                    <a href="./posts.php?source=create">Add Post</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i>Categories</a>
        </li>
        
        <li>
            <a href="./comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="users.php">View All Users</a>
                </li>
                <li>
                    <a href="users.php?source=create">Create User</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="./profile.php"><i class="fa fa-fw fa-file"></i> Profile</a>
        </li>
    </ul>
</div>