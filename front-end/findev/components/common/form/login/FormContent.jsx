import Link from "next/link";
import LoginWithSocial from "./LoginWithSocial";

const FormContent = () => {
  return (
    <div className="form-inner">
      <h3>Đăng Nhập</h3>

      {/* <!--Login Form--> */}
      <form method="post">
        <div className="form-group">
          <label>Tên tài khoản</label>
          <input type="text" name="username" placeholder="Nhập tên tài khoản" required />
        </div>
        {/* name */}

        <div className="form-group">
          <label>Mật khẩu</label>
          <input type="password" name="password" placeholder="Nhập mật khẩu" />
        </div>
        {/* password */}

        <div className="form-group">
          <div className="field-outer">
            <div className="input-group checkboxes square">
              <input type="checkbox" name="remember-me" id="remember" />
              <label htmlFor="remember" className="remember">
                <span className="custom-checkbox"></span> Ghi nhớ đăng nhập
              </label>
            </div>
            <a href="#" className="pwd">
              Quên mật khẩu?
            </a>
          </div>
        </div>
        {/* forgot password */}

        <div className="form-group">
          <button
            className="theme-btn btn-style-one"
            type="submit"
            name="log-in"
          >
            Đăng nhập
          </button>
        </div>
        {/* login */}
      </form>
      {/* End form */}

      <div className="bottom-box">
        <div className="text">
          Bạn không có tài khoản?{" "}
          <Link
            href="#"
            className="call-modal signup"
            data-bs-dismiss="modal"
            data-bs-target="#registerModal"
            data-bs-toggle="modal"
          >
            Đăng ký ngay!
          </Link>
        </div>

        <div className="divider">
          <span>Hoặc</span>
        </div>

        <LoginWithSocial />
      </div>
      {/* End bottom-box LoginWithSocial */}
    </div>
  );
};

export default FormContent;
