{{Form::open(array('route' => 'users.store', 'class' => 'user-edit-form'));}}
{{Form::hidden('id', $user->id)}}
    <table class="edit-users">

        <tr class="edit-users-row">
            <td class="edit-users-label id">ID</td>
            <td class="edit-users-value id">{{$user->id}}</td>
        </tr>
        <tr class="edit-users-row">
            <td class="edit-users-label username">User Name</td>
            <td class="edit-users-value username">{{Form::text('username', $user->username, array('class' => 'user-edit username form-singleline-text'))}}</td>
        </tr>
        <tr class="edit-users-row">
            <td class="edit-users-label realname">Real Name</td>
            <td class="edit-users-value realname">{{Form::text('realname', $user->realname, array('class' => 'user-edit realname form-singleline-text'))}}</td>
        </tr>
        <tr class="edit-users-row">
            <td class="edit-users-label email">Email</td>
            <td class="edit-users-value email">{{Form::email('email', $user->email, array('class' => 'user-edit email form-singleline-text'))}}</td>
        </tr>
        <tr class="edit-users-row">
            <td class="edit-users-label homebranch">Home Branch {{$user->home_branch}}</td>
            <td class="edit-users-value homebranch"> {{Form::select('home_branch', $branches, $user->home_branch, array('class' => 'user-edit homebranch form-singleline-text'))}}
        </tr>
        <tr class="edit-users-row">
            <td class="edit-users-label isadmin">Is Administrator</td>
            <td class="edit-users-value isadmin">{{ Form::checkbox('is_admin', '1', $user->is_admin == 1, array('class' => 'user-edit is-admin'))  }}</td>
        </tr>
    </table>

{{Form::close();}}
