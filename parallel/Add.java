public class Add implements Runnable { 
	private int start;
	private int end;
	private int[] A;
	private int[] B;
	int[] C = new int[1000];
	
	
	public Add(int[] A, int[] B, int start, int end) {
		this.start = start;
		this.end = end;
		this.A = A;
		this.B = B;
    }
    
	public void run() {
    	for (int i=start; i <=end; i++) {
    		C[i] = A[i]+B[i];  		
    	}
    	
    }
    public int[] getArray() {
    	return C; }
}