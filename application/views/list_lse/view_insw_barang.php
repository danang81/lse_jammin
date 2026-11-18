
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<br>
<div class="row-fluid">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- widget div-->
            <div>
					<fieldset>
					<legend class="text-info"><strong>DETAIL INSW BARANG</strong>
					<a href="#" class="btn btn-success btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>list_lse/CTRL_New_Barang/<?php echo $id;?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-plus"></i></a>
					</legend>
					<table class="table table-striped table-bordered table-hover">
					<thead class="danger">
						<tr>
						<th class="text-center">No. Seri</th>
						<th class="text-center">Nama Kategori Eksportir</th>
						<th class="text-center">Kode HS</th>
						<th class="text-center">Uraian Barang</th>
						<th class="text-center">Harga Satuan</th>
						<th class="text-center">FOB</th>
						<th class="text-center">Jumlah Tonase</th>
						<th class="text-center">Asal Barang</th>
						<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$count = 1;
						foreach ($barang as $row) {
						?>
							<tr>
								<td class="text-center"><?php echo $row->seriBarang; ?></td>
								<td><?php echo $row->namaKategoriEksportir; ?></td>
								<td><?php echo $row->kodeHs; ?></td>
								<td><?php echo $row->uraianBarang; ?></td>
								<td><?php echo number_format($row->hargaSatuan, 2, ".", ","); ?></td>
								<td><?php echo number_format($row->fob, 2, ".", ","); ?></td>
								<td><?php echo $row->jumlahTonase; ?></td>
								<td><?php echo $row->asalBarang; ?></td>

								<?php  if($row->isAddition == ''){?>
									<td class="center">
										<a href="#" onclick="PopUpWindow('<?php echo $url_view.$row->id; ?>','mywindow',1200,600,'yes','yes'); return false;"><button class="btn btn-xs btn-primary"><i class="fa fa-eye bigger-120"></i></button>

										<a href="#" onclick="PopUpWindow('<?php echo base_url(); ?>list_lse/CTRL_Edit_Barang/<?php echo $row->id;?>','mywindow', 800, 600, 'yes', 'yes'); return false;"><button class="btn btn-xs btn-success"><i class="fa fa-pencil bigger-120"></i></button></a>
                                        
									</td>
								<?php } else {?>
									<td class="center">
                                        <a href="#" onclick="PopUpWindow('<?php echo $url_view.$row->id; ?>','mywindow',1200,600,'yes','yes'); return false;"><button class="btn btn-xs btn-primary"><i class="fa fa-eye bigger-120"></i></button></a>
                                        <a href="#" onclick="PopUpWindow('<?php echo base_url(); ?>list_lse/CTRL_Edit_Barang/<?php echo $row->id;?>','mywindow', 800, 600, 'yes', 'yes'); return false;"><button class="btn btn-xs btn-success"><i class="fa fa-pencil bigger-120"></i></button></a>

                                         <?php if($kodeProses <> '050'){ ?>
                                            <a href="../../list_lse/CTRL_Delete_Barang/<?php echo $row->id; ?>/<?php echo $id ?>" class="btn btn-xs btn-danger"onclick="if (!confirm('Are u sure to Delete Data Barang?'))
                                                {
                                                    return false;
                                                }
                                            ;"><i class="fa fa-trash"></i></a>
                                        <?php } ?>
                                    </td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
					</table>
						</fieldset>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-12">
									&nbsp;
									<button type="button" id="prevButtonQuality" class="btn btn-small btn-default "><i class="fa fa-arrow-left"></i> Previous Tab</button>
									&nbsp; 
									<button type="button" id="nextButtonPort" class="btn btn-small btn-primary "><i class="fa fa-arrow-right"></i> Next Tab</button>
								</div>
							</div>
						</div>
				<?php echo form_close(); ?>
            </div>
        </article>
    </div>

</div>

<link href="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.init.js"></script>

<?php if ($this->session->flashdata('msgsubmitbarang')) { ?>
    <script>
        swal({
            title: "Success",
            text: "Data Has Been Submit",
            timer: 3500,
            showConfirmButton: true,
            type: 'success'
        });
    </script>
<?php } ?>

<?php if ($this->session->flashdata('msgkerjasama') || $this->session->flashdata('msgeditbarang')) { ?>
    <script>
        swal({
            title: "Success",
            text: "Data Has Been Updated",
            timer: 3500,
            showConfirmButton: true,
            type: 'success'
        });
    </script>
<?php } ?>
    
<?php if ($this->session->flashdata('msgdeletebarang')) { ?>
    <script>
        swal({
            title: "Success",
            text: "Data Has Been Deleted",
            timer: 3500,
            showConfirmButton: true,
            type: 'success'
        });
    </script>
<?php } ?>