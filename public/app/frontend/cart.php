<?php
include_once __DIR__ . '/partials/header.php';
?>
    <title>Giỏ hàng</title>
<?php
include_once __DIR__ . '/partials/navbar.php';
?>
    <main>
        <div class="container">
            <div class="cart-top">
                <ul>
                    <li class="active">Giỏ hàng</li>
                    <li>Đặt hàng</li>
                    <li>Thanh toán</li>
                    <li>Hoàn thành hóa đơn</li>
                </ul>
            </div>
            <div class="cart-main d-flex">
                <div class="cart-left">
                    <h2>Giỏ hàng của bạn <span>2 Sản Phẩm</span></h2>
                    <table>
                        <thead>
                            <tr class="item">
                                <th>TÊN SẢN PHẨM</th>
                                <th>CHIẾU KHẤU</th>
                                <th>SỐ LƯỢNG</th>
                                <th>TỔNG TIỀN</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="item">
                                <td>
                                    <div class="cart-item d-flex">
                                        <div class="cart-item-img">
                                            <img src="../images/moda/sp1.1.jpg" alt="">
                                        </div>
                                        <div class="cart-item-content">
                                            <h3>Áo khoác Twill dáng lửng</h3>
                                            <div class="cart-item-properties d-flex">
                                                <p>Màu sắc: <span>Be sáng</span></p>
                                                <p>Size: <span>L</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p>-745.000đ</p>
                                    <p style="line-height: 16px; color: rgb(184, 7, 7); font-size: 14px; font-weight: 600;">( -50% )</p>
                                </td>
                                <td>
                                    <div class="quantity-input d-flex">
                                        <input type="number" value="1" name="quantity" class="cart-quantity-input">
                                        <div class="quantity-increase increase d-flex">+</div>
                                        <div class="quantity-decrease decrease d-flex">-</div>
                                    </div>
                                </td>
                                <td>
                                    <strong><span>745.000đ</span></strong>
                                </td>
                                <td>
                                    <button class="btn-remove-item"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>
                            <tr class="item">
                                <td>
                                    <div class="cart-item d-flex">
                                        <div class="cart-item-img">
                                            <img src="../images/moda/sp2.1.jpg" alt="">
                                        </div>
                                        <div class="cart-item-content">
                                            <h3>Áo khoác Twill dáng lửng</h3>
                                            <div class="cart-item-properties d-flex">
                                                <p>Màu sắc: <span>Be sáng</span></p>
                                                <p>Size: <span>L</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p>-745.000đ</p>
                                    <p style="line-height: 16px; color: rgb(184, 7, 7); font-size: 14px; font-weight: 600;">( -50% )</p>
                                </td>
                                <td>
                                    <div class="quantity-input d-flex">
                                        <input type="number" value="1" name="quantity" class="cart-quantity-input">
                                        <div class="quantity-increase increase d-flex">+</div>
                                        <div class="quantity-decrease decrease d-flex">-</div>
                                    </div>
                                </td>
                                <td>
                                    <strong><span>745.000đ</span></strong>
                                </td>
                                <td>
                                    <button class="btn-remove-item"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>
                            <tr class="item">
                                <td>
                                    <div class="cart-item d-flex">
                                        <div class="cart-item-img">
                                            <img src="../images/moda/sp3.1.jpg" alt="">
                                        </div>
                                        <div class="cart-item-content">
                                            <h3>Áo khoác Twill dáng lửng</h3>
                                            <div class="cart-item-properties d-flex">
                                                <p>Màu sắc: <span>Be sáng</span></p>
                                                <p>Size: <span>L</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p>-745.000đ</p>
                                    <p style="line-height: 16px; color: rgb(184, 7, 7); font-size: 14px; font-weight: 600;">( -50% )</p>
                                </td>
                                <td>
                                    <div class="quantity-input d-flex">
                                        <input type="number" value="1" name="quantity" class="cart-quantity-input">
                                        <div class="quantity-increase increase d-flex">+</div>
                                        <div class="quantity-decrease decrease d-flex">-</div>
                                    </div>
                                </td>
                                <td>
                                    <strong><span>745.000đ</span></strong>
                                </td>
                                <td>
                                    <button class="btn-remove-item"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>
                            <tr class="item">
                                <td>
                                    <div class="cart-item d-flex">
                                        <div class="cart-item-img">
                                            <img src="../images/moda/sp4.1.jpg" alt="">
                                        </div>
                                        <div class="cart-item-content">
                                            <h3>Áo khoác Twill dáng lửng</h3>
                                            <div class="cart-item-properties d-flex">
                                                <p>Màu sắc: <span>Be sáng</span></p>
                                                <p>Size: <span>L</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p>-745.000đ</p>
                                    <p style="line-height: 16px; color: rgb(184, 7, 7); font-size: 14px; font-weight: 600;">( -50% )</p>
                                </td>
                                <td>
                                    <div class="quantity-input d-flex">
                                        <input type="number" value="1" name="quantity" class="cart-quantity-input">
                                        <div class="quantity-increase increase d-flex">+</div>
                                        <div class="quantity-decrease decrease d-flex">-</div>
                                    </div>
                                </td>
                                <td>
                                    <strong><span>745.000đ</span></strong>
                                </td>
                                <td>
                                    <button class="btn-remove-item"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>
                            <tr class="item">
                                <td>
                                    <div class="cart-item d-flex">
                                        <div class="cart-item-img">
                                            <img src="../images/moda/sp5.1.jpg" alt="">
                                        </div>
                                        <div class="cart-item-content">
                                            <h3>Áo khoác Twill dáng lửng</h3>
                                            <div class="cart-item-properties d-flex">
                                                <p>Màu sắc: <span>Be sáng</span></p>
                                                <p>Size: <span>L</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p>-745.000đ</p>
                                    <p style="line-height: 16px; color: rgb(184, 7, 7); font-size: 14px; font-weight: 600;">( -50% )</p>
                                </td>
                                <td>
                                    <div class="quantity-input d-flex">
                                        <input type="number" value="1" name="quantity" class="cart-quantity-input">
                                        <div class="quantity-increase increase d-flex">+</div>
                                        <div class="quantity-decrease decrease d-flex">-</div>
                                    </div>
                                </td>
                                <td>
                                    <strong><span>745.000đ</span></strong>
                                </td>
                                <td>
                                    <button class="btn-remove-item"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                    <div class="cart-continue button--outline">
                        <a href="product.html">
                            <i class="fa-solid fa-arrow-left"></i>
                            Tiếp tục mua hàng
                        </a>
                    </div>
                </div>
                <div class="cart-right">
                    <div class="cart-summary">
                        <div class="cart-summary-overview">
                            <h3>Tổng tiền giỏ hàng</h3>
                            <div class="cart-summary-overview-item d-flex">
                                <p>Tổng sản phẩm</p>
                                <p>5</p>
                            </div>
                            <div class="cart-summary-overview-item d-flex">
                                <p>Tổng tiền hàng</p>
                                <p>3.725.000đ</p>
                            </div>
                            <div class="cart-summary-overview-item d-flex">
                                <p>Thành tiền</p>
                                <p><b>2.980.000đ</b></p>
                            </div>
                            <div class="cart-summary-overview-item d-flex">
                                <p>Tạm tính</p>
                                <p><b>2.980.000đ</b></p>
                            </div>
                        </div>
                        <div class="cart-summary-note d-flex">
                            <i class="fa-solid fa-exclamation"></i>
                            <p style="width: 92%;">Miễn <b>đổi trả</b> đối với sản phẩm đồng giá / sale trên 50%</p>
                        </div>
                    </div>
                    <div class="button--outline">
                        <a href="delivery.html">
                            Đặt hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
include_once __DIR__ . '/partials/footer.php';
?>
    <script src="../js/cart.js"></script>
</body>
</html>