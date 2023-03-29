const menuItems = [
    {
      key: '1',
      title: 'Tìm Việc Mới Nhất',
      children: [
          {
              key: '1.1',
              title: 'Việc Làm Theo Ngành Nghề',
              children: [
                  {
                      key: '1.1.1',
                      title: 'Việc Làm IT'
                  },
                  {
                      key: '1.1.2',
                      title: 'Việc Làm Kế Toán'
                  },
                  {
                      key: '1.1.3',
                      title: 'Việc Làm Bán Hàng'
                  },
                  {
                      key: '1.1.4',
                      title: 'Việc Làm Bán Thời Gian' 
                  },
                  {
                      key: '1.1.5',
                      title: 'Việc Làm Khác'
                  },
              ]
          },
          {
              key: '1.2',
              title: 'Việc Làm Theo Khu Vực',
              children: [
                  {
                      key: '1.2.1',
                      title: 'Việc Làm Hà Nội'
                  },
                  {
                      key: '1.2.2',
                      title: 'Việc Làm TP Hồ Chí Minh'
                  },
                  {
                      key: '1.2.3',
                      title: 'Việc Làm Đà Nẵng'
                  },
                  {
                    key: '1.2.4',
                    title: 'Việc Làm Các Tỉnh Khác'
                  }
              ]
          },
      ]
    },
    {
        key: '2',
        title: 'Công ty',
        children: [
            {
                key: '2.1',
                title: 'Công Ty HOT',
            },
            {
                key: '2.2',
                title: 'Tất Cả Công Ty'
            }
        ]
    },
    {
        key: '3',
        title: 'Tạo CV'
    },
    {
        key: '4',
        title: 'Diễn Đàn'
    },
    {
        key: '5',
        title: 'Liên Hệ'
    }
  ];
  
  export default menuItems;
  