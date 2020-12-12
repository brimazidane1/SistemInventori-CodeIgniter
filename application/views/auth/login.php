<body class="bg-dark">

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <?= $this->session->flashdata('tes'); ?>
            <div class="card-header">Login</div>
            <div class="card-body">

                <form class="user" method="post" action="<?= base_url('login'); ?>">
                    <div class="form-group">
                        <div class="form-group">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Email address" autofocus="autofocus" value="<?= set_value('username'); ?>">
                        </div>
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">

                        </div>
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                </form>

            </div>
        </div>
    </div>