<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<br>
<div class="row-fluid">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- widget div-->
            <div>
			<?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
					<fieldset>
					<legend class="text-info"><strong>DETAIL INSW KERJASAMA</strong>
                    
                    <span class="btn btn-primary btn-small" id="btnAddRow"> <i class="fa fa-plus"></i></span>
                    
                    </legend>
					<table class="table table-striped table-bordered table-hover">
					<thead class="danger">
						<tr>
						<th class="text-center">Kode Kategori Barang</th>
						<th class="text-center">Nama Kategori Barang</th>
						<th class="text-center">Nama Perusahaan Asal Barang</th>
						<th class="text-center">Nomor NTPN</th>
						<th class="text-center">Tanggal NTPN</th>
						<th class="text-center">Valuta</th>
						<th class="text-center">Royalti Dp</th>
						<th class="text-center">NPWP Penjual</th>
						<th class="text-center">NPWP Penambang</th>
						<th class="text-center">NPWP Trader</th>
						<th class="text-center">Tonase Pembelian</th>
						<th class="text-center">Tonase Ekspor</th>
						</tr>
					</thead>
					<tbody id="itemRow">
					<?php
					$count = 1;
                    if(count($kerjasama) > 0){
                        foreach ($kerjasama as $key => $row) {
                            if($row->isAddition){
                                $disabled = "";
                            } else{
                                $disabled = "disabled='disabled'";
                            }
                    ?>
                   <tr>
                        <td class="text-center">
                            <?php echo $row->kodeKategoriBarang; ?>
                            <input type="hidden" name="kerjasama[<?= $key ?>][kodeKategoriBarang]" value="<?= $row->kodeKategoriBarang ?>" id="kodeKategoriBarang<?= $key ?>"/>
                        </td>
                        <td>
                            <select class="chzn-select" name="kerjasama[<?= $key ?>][nama_kategori]" <?= $disabled; ?>>
                                <?php foreach ($option_kategori as $k => $v) { ?>
                                    <option value="<?= $k ?>" <?= $row->kodeKategoriBarang == $k ? 'selected' : '' ?>><?= $v ?></option>
                                <?php } ?>
                            </select>
                            </td>
                        <td>
                            <input type="text" name="kerjasama[<?= $key ?>][nama_perusahaan_barang]" value="<?= $row->nama_perusahaan_barang ?>" id="nama_perusahaan_barang_<?= $key ?>"/>
                        </td>
                        <td><?php echo $row->nomorNtpn; ?></td>
                        <td>
                            <input type="text" style="width:80px" name="kerjasama[<?= $key ?>][tanggal_ntpn]" placeholder="Tanggal NTPN" value="<?= $row->tanggalNtpn ?>" id="tanggal_ntpn_<?= $key ?>" class="tanggal_ntpn"<?= $disabled; ?>/>
                        </td>
                        <td align="center">
                            <select class="chzn-select" name="kerjasama[<?= $key ?>][valuta]" style="width:100px">
                                <?php foreach ($currency as $c) { ?>
                                    <option value="<?= $c->id ?>" <?= $row->valuta == $c->id ? 'selected' : '' ?>><?= $c->name ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="kerjasama[<?= $key ?>][id_kerjasama]" value="<?= $row->id ?>">
                            <input type="hidden" name="kerjasama[<?= $key ?>][isAddition]" value="<?= $row->isAddition ?>">
                        </td>
                        <td align="center"><input type="text" style="width:100px" name="kerjasama[<?= $key ?>][royalty_dp]" placeholder="royalti dimuka" value="<?= $row->royalty_dp ?>" id="royalty_dp_<?= $key ?>" onkeypress="return isNumberKey(event)"/></td>
                        <td>
                            <input type="text" name="kerjasama[<?= $key ?>][npwp_penjual]" placeholder="NPWP Penjual" value="<?= $row->npwpPenjual ?>" id="npwp_penjual_<?= $key ?>" onkeypress="return isNumberKey(event)"/>
                        </td>
                        <td>
                            <input type="text" name="kerjasama[<?= $key ?>][npwp_penambang]" placeholder="NPWP Penambang" value="<?= $row->npwpPenambang ?>" id="npwp_penambang_<?= $key ?>" onkeypress="return isNumberKey(event)" />
                        </td>
                        <td>
                            <input type="text" name="kerjasama[<?= $key ?>][npwp_trader]" placeholder="NPWP Trader" value="<?= $row->npwpTrader ?>" id="npwp_trader_<?= $key ?>" onkeypress="return isNumberKey(event)" />
                        </td>
                        <td>
                            <input type="text" name="kerjasama[<?= $key ?>][tonase_pembelian]" placeholder="Tonase Pembelian" value="<?= $row->tonasePembelian ?>" id="tonase_pembelian_<?= $key ?>" <?= $disabled; ?>/>
                        </td>
                        <td>
                            <input type="text" name="kerjasama[<?= $key ?>][tonase_ekspor]" placeholder="Tonase Ekspor" value="<?= $row->tonaseEkspor ?>" id="tonase_ekspor_<?= $key ?>"/>

                            <select name="kerjasama[<?= $key ?>][number_format]" id="numberFormat<?= $key ?>" onchange="setNumberFormat5()">
                                <option value="0,0.00" <?=$row->number_format == "0,0.00" ? 'selected' : '' ?>>0,0.00</option>
                                <option value="0,0.000" <?=$row->number_format == "0,0.000" ? 'selected' : '' ?>>0,0.000</option>
                                <option value="0,0.0000" <?=$row->number_format == "0,0.0000" ? 'selected' : '' ?>>0,0.0000</option>
                            </select>
                        </td>
                        <?php if($row->isAddition){ ?>
                        <td align="center">
                            <a href="../../list_lse/CTRL_Delete_Kerjasama_Barang/<?php echo $row->id; ?>" class="btn btn-mini btn-danger"onclick="if (!confirm('Delete Data?'))
                                {
                                    return false;
                                }
                            ;"><i class="fa fa-trash"></i></a>
                        </td>
                        <?php } ?>
	               </tr>
                    <?php } $last_num = $key + 1;
                    } else {
                        $last_num = 0;
                    } ?>
                    <input type="hidden" id="last_num" value="<?= $last_num ?>"/>
				</tbody>
				</table>
                </fieldset>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" name="close" value="close" class="btn btn-small btn-default" onclick="self.close();"><i class="fa fa-remove"></i> Close</button>
                                <?php
                                echo nbs(1);
                                // echo form_hidden('id', $no_lse);
                               
                                ?>
                                <button type="submit" name="btn_submit" value="Save" class="btn btn-small btn-primary"><i class="fa fa-save"></i> Submit</button>
                                
                            </div>
                        </div>
                    </div>				
                <?php echo form_close(); ?>
            </div>
        </article>
    </div>
</div>

<script>
    $(function () {
        var j = $('#last_num').val();
        console.log(j);
        var num = 1;
        $('#btnAddRow').click(function () {
            $("#itemRow").append('<tr id="row' + j + '">' +
                    '<td></td>' +
                    '<td><select name="kerjasama[' + j + '][nama_kategori]" class="optionNamaKategori' + num + ' span12" id="nama_kategori_' + j + '" >\n\
                    <option value="1">Milik Sendiri</option>\n\
                    <option value="2">Beli dari Penambang Lain</option>\n\
                    <option value="3">Beli dari Trader</option>\n\</select></td>' +
                    '<td style="width:10%" align="center"><input type="text" id="nama_perusahaan_barang_'+ j +'"  name="kerjasama[' + j + '][nama_perusahaan_barang]"/></td>' +
                    '<td style="width:10%" align="center">SELISIHLEBIHMUAT</td>' +
                    '<td align="center" width="10%"><input type="text" style="width:80px"  name="kerjasama[' + j + '][tanggal_ntpn]" id="tanggal_ntpn_' + j + '" placeholder="Tanggal NTPN"/></td>' +
                    '<td style="width:10%" align="center"><select name="kerjasama[' + j + '][valuta]" class="optionValuta' + num + ' span12" id="valuta_' + j + '" ></select></td>' +
                    '<td style="width:10%" align="center"><input type="text" style="width:100px" id="royalty_dp_'+ j +'"  name="kerjasama[' + j + '][royalty_dp]" placeholder="Royalti DP" onkeypress="return isNumberKey(event)"/></td>' +
                    '<td style="width:10%" align="center"><input type="text" id="npwp_penjual_'+ j +'"  name="kerjasama[' + j + '][npwp_penjual]" placeholder="NPWP Penjual" onkeypress="return isNumberKey(event)"/></td>' +
                    '<td style="width:10%" align="center"><input type="text" id="npwp_penambang_'+ j +'"  name="kerjasama[' + j + '][npwp_penambang]" placeholder="NPWP Penambang" onkeypress="return isNumberKey(event)"/></td>' +
                    '<td style="width:10%" align="center"><input type="text" id="npwp_trader_'+ j +'"  name="kerjasama[' + j + '][npwp_trader]" placeholder="NPWP Trader" onkeypress="return isNumberKey(event)"/></td>' +
                    '<td style="width:10%" align="center"><input type="text" id="tonase_pembelian_'+ j +'"  name="kerjasama[' + j + '][tonase_pembelian]" placeholder="Tonase Pembelian" onkeypress="return isNumberKey(event)"/></td>' +
                    '<td style="width:10%" align="center"><input type="text" id="tonase_ekspor_'+ j +'"  name="kerjasama[' + j + '][tonase_ekspor]" placeholder="Tonase Ekspor" onkeypress="return isNumberKey(event)"/></td>' +
                    '<td style="width:5%" ><a class="btn btn-mini btn-danger" onclick="delRow(' + j + ')"><i class="fa fa-remove"></i></a></td>' +
                    '<input type="hidden" name="kerjasama[' + j + '][id_kerjasama]"</td>' +
                    '</tr>');
        
        $("#tanggal_ntpn_" + j).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
        
        $.get("<?= base_url() ?>list_lse/get_valuta", function (data) {
            var pointer = num - 1;
            var parse = JSON.parse(data);
            var result = parse.result;

            $(".optionValuta" + pointer).append('<option value=""> -- Select Valuta -- </option>');
            $.each(result, function (i, val) {
                $(".optionValuta" + pointer).append('<option value="' + this.id + '">' + this.name + '</option>');
            });
            $(".optionValuta"+pointer).chosen({width: "100%"});
            
            $(".optionNamaKategori"+pointer).chosen({width: "100%"});
        });

        num++;
        j++;
        
        });
                
        $(".tanggal_ntpn").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    });
    
    function delRow(j)
    {
        $("#row" + j).remove();
        calculate();
    }
</script>