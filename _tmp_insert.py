# -*- coding: utf-8 -*-
from pathlib import Path
import sys
path = Path('admin/index.php')
data = path.read_text(encoding='utf-8')
marker = "        <button type=\"submit\" class=\"btn\">Lưu cấu hình</button>"
fish_block = """        <div style=\"border:1px solid #eee; padding:10px; border-radius:6px;\">
            <p style=\"margin:0 0 8px 0; font-weight:bold;\">Nhập ID cá cảnh cho mục \"Cá cảnh mới\" (cách nhau bởi dấu phẩy hoặc khoảng trắng):</p>
            <input type=\"text\" name=\"featured_fish_ids\" value=\"<?= htmlspecialchars($featuredFishInput) ?>\" placeholder=\"ví dụ: 2, 4, 9\">
            <small>Thứ tự ID bạn nhập sẽ là thứ tự hiển thị. Để trống sẽ tự lấy 6 cá mới nhất.</small>
        </div>

"""
if marker not in data:
    sys.exit('marker not found')
path.write_text(data.replace(marker, fish_block + marker, 1), encoding='utf-8')
