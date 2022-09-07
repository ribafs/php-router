<div class="container">
	<a class="btn btn-primary btn-sm mt-3" href="<?=URL . 'customers/add'; ?>">Add Customer</a>
    <div>
        <br>        
        <table class="table table-hover table-stripped">
            <thead>
            <tr class="bg-gray">
                <td><b>ID</b></td>
                <td><b>Name</b></td>
                <td><b>E-mail</b></td>
                <td colspan="2" align="center">Actions</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($allRegs as $customer) { ?>
                <tr>
                    <td><?php if (isset($customer->id)) echo htmlspecialchars($customer->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($customer->name)) echo htmlspecialchars($customer->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($customer->email)) echo htmlspecialchars($customer->email, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'customers/edit/' . htmlspecialchars($customer->id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a></td>
                    <td><a onclick="return confirm('Realmente excluir o cliente ?')" href="<?php echo URL . 'customers/delete/' . htmlspecialchars($customer->id, ENT_QUOTES, 'UTF-8'); ?>">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
