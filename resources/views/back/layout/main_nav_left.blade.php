<aside id="left-panel">
    <nav>
        <ul>
            <li class="">
                <a href="#" title="User"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">User</span></a>
                <ul>
                    <li class="{{ Menu::isActive('admin.user.index') }}">
                        <a href="/admin/user" title="List"><span class="menu-item-parent">List</span></a>
                    </li>                    
                    <li class="{{ Menu::isActive('admin.user.create') }} {{ Menu::isActive('admin.user.edit') }}">
                        <a href="/admin/user/create" title="List"><span class="menu-item-parent">Create</span></a>
                    </li>

                </ul>
            </li>            
            <li class="">
                <a href="#" title="User"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">task</span></a>
                <ul>
                    <li class="{{ Menu::isActive('admin.task.index') }}">
                        <a href="/admin/task/" title="List"><span class="menu-item-parent">All list</span></a>
                    </li>
                    <li class="{{ Menu::isActive('admin.task.create') }} {{ Menu::isActive('admin.task.edit') }}">
                        <a href="/admin/task/create" title="List"><span class="menu-item-parent">Create</span></a>
                    </li>
                
                </ul>
            </li>
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>
</aside>