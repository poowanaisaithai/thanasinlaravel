<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จรับเงิน - งวดที่ {{ $installment->installment_number }}</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: 'THSarabunNew', sans-serif;
            margin: 0;
            padding: 0px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2px;
        }

        .logo {
            width: 50px;
            padding: 10px;
            background: #1a56db;
            color: white;
            text-align: center;
            border-radius: 8px;
        }

        .company-info {
            margin-left: 20px;
            flex-grow: 1;
        }

        .date-info {
            text-align: right;
        }

        .title-bar {
            background: #f4702f;
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 20px;
            font-weight: bold;
            margin: 5px 0;
        }

        .content {
            display: flex;
            gap: 20px;
        }

        .left-column, .right-column {
            border: 1px solid #000;
            padding: 15px;
        }

        .left-column {
            flex: 1;
        }

        .right-column {
            flex: 2;
        }

        .amount-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .total {
            border-top: 1px solid #000;
            margin-top: 10px;
            padding-top: 10px;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .signature-line {
            width: 200px;
            text-align: center;
        }

        .signature-line::before {
            content: '';
            display: block;
            width: 100%;
            border-top: 1px solid #000;
            margin-bottom: 10px;
        }

        .footer-note {
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            {{-- <div class="logo">
                <img src="resources/assets/images/thanasin.svg" alt="ธนสิน" style="max-width: 100px; height: auto;">
            </div> --}}
            <div class="company-info">
                <div style="font-weight: bold;">หจก. ธนสิน(มุกดาหาร)</div>
                <div>81/57 ซอยตาดแคน 12 ถนนตาดแคน ตำบลมุกดาหาร อำเภอเมืองมุกดาหาร จ.มุกดาหาร 49000</div>
                <div>โทร 095-6659807</div>
         
                <div>สาขา สำนักงานใหญ่</div>
            </div>
            <div class="date-info">
                <div>วันที่ {{ $installment->date }}</div>
                <div>เลขที่ R{{ str_pad($installment->id, 8, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        <!-- Title -->
        <div class="title-bar">
            ต้นฉบับ ใบเสร็จรับเงิน
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Left Column -->
            <div class="left-column">
                <div style="font-weight: bold;">หนี้เงินที่ต้องชำระ</div>
                <div class="amount-row">
                    <span>เงินต้น</span>
                    <span>฿{{ number_format($installment->remaining_balance, 2) }}</span>
                </div>
                <div class="amount-row">
                    <span>ค่าทวงถาม</span>
                    <span>฿{{ number_format($installment->collection_fee, 2) }}</span>
                </div>
                <div class="amount-row">
                    <span>ค่าปรับ</span>
                    <span>฿0.00</span>
                </div>
            
                <div class="amount-row">
                    <span>ดอกเบี้ย</span>
                    <span>฿{{ number_format($installment->interest, 2) }}</span>
                </div>
            </div>

            <!-- Right Column -->
            <div class="right-column">
                <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                    <div>รายละเอียดการชำระเงิน</div>
                    <div>งวดที่ {{ $installment->installment_number }}</div>
                    <div>จำนวนเงิน (บาท)</div>
                </div>

                <div class="amount-row">
                    <span>เงินต้น</span>
                    <span>฿{{ number_format($installment->principal_return, 2) }}</span>
                </div>
                <div class="amount-row">
                    <span>ค่าทวงถาม</span>
                    <span>฿{{ number_format($installment->collection_fee, 2) }}</span>
                </div>
                <div class="amount-row">
                    <span>ดอกเบี้ยที่ชำระ</span>
                    <span>฿{{ number_format($installment->interest, 2) }}</span>
                </div>

                <div class="total">
                    <div>รวมเงินที่ชำระ {{ ($installment->payment_amount) }}</div>
                    <div>ชำระโดย เงินสด</div>
                    <div style="text-align: right; font-weight: bold; font-size: 20px;">
                        ฿{{ number_format($installment->payment_amount, 2) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-note">
            <div>โปรดตรวจสอบความถูกต้อง หากมีข้อสงสัย</div>
            <div>กรุณาติดต่อสาขาที่ชำระเงินภายใน 7 วัน</div>
        </div>

        <div class="signatures">
            <div class="signature-line">
                <div>ผู้ชำระเงิน</div>
            </div>
            <div class="signature-line">
                <div>ผู้รับเงิน/ผู้มีอำนาจลงนาม</div>
            </div>
        </div>
    </div>
</body>
</html>