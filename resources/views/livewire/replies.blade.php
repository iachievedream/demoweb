<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <!-- 評論回覆 -->
    <div class="card shadow mb-4">
        <div class="card-body p-4">

            <div class="form-floating mb-3">
                <!-- 這裡使用 wire:model 進行 Data Binding -->
                <textarea wire:model="content" id="floatingTextarea"
                placeholder="content" class="form-control"
                style="height: 100px;"></textarea>

                <label for="floatingTextarea">留個話吧~</label>
            </div>

            <div class="d-flex justify-content-between">
                <!-- 錯誤訊息顯示 -->
                <div class="d-flex justify-content-center align-items-center">
                    @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>
