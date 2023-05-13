const FormContent = () => {
  return (
    <form method="post" action="add-parcel.html">
      <div className="form-group">
        <label>Địa chỉ Email</label>
        <input type="email" name="username" placeholder="Nhập Email của bạn" required />
      </div>
      {/* name */}

      <div className="form-group">
        <label>Mật khẩu</label>
        <input
          id="password-field"
          type="password"
          name="password"
          placeholder="Nhập mật khẩu"
        />
      </div>
      {/* password */}

      <div className="form-group">
        <button className="theme-btn btn-style-one" type="submit">
          Đăng ký
        </button>
      </div>
      {/* login */}
    </form>
  );
};

export default FormContent;
