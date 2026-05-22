<div style="
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 20px;
    padding: 12px 24px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 9999;
">
    <a href="/home" wire:navigate>🏠 Home</a>
    <a href="/cinnamon" wire:navigate>🐱 Cinnamon</a>
<form method="POST" action="{{ route('logout') }}" style="margin:0;">
    @csrf
    <button type="submit" style="
        all: unset;
        cursor: pointer;
        font-weight: bold;
        color: #ff6fa5;
    ">
        🚪 Logout
    </button>
</form>
</div>